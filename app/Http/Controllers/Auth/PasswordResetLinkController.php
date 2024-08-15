<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\ResetUserPasswordJob;
use App\Models\UserManagement\User;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /***
     *
     * @return
     */
    public function index()
    {
        $this->setPageTitle(trans('auth.reset_password'));
        return view('pages.auth.forgot-password');
    }


    /***
     *
     * @return
     */
    public function sendPasswordResetLink(ResetPasswordRequest $request, RateLimiter $limiter)
    {
        $email = $request->get('email');
        if ($limiter->tooManyAttempts($this->throttleKey($email), 3)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($this->throttleKey($email));
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }
        $user = User::query()->where('login', $email)->first();
        if ($user instanceof User) {
            $this->dispatchSync(new ResetUserPasswordJob($user));
            $limiter->clear($this->throttleKey($email));
        }
        $limiter->hit($this->throttleKey($email));

        $this->success( trans('auth.reset_password') , trans('auth.reset_password_sent', ['email' => $email]));
        return back();
    }


    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey($email): string
    {
        return Str::transliterate(Str::lower($email) . '|' . '1221.1221.15');
    }

}
