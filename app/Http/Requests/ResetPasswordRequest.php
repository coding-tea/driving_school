<?php

namespace App\Http\Requests;

use App\Jobs\ResetUserPasswordJob;
use App\Models\UserManagement\User;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ResetPasswordRequest extends FormRequest
{
    use  DispatchesJobs;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }


    /***
     *
     * @return
     */
    public function sendEmail()
    {
        $limiter = app(RateLimiter::class);
        $email = $this->get('email');
        if ($limiter->tooManyAttempts($this->throttleKey(), 3)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }
        $user = User::query()->where('email',)->first();
        if ($user instanceof User) {
           $this->dispatchSync(new ResetUserPasswordJob($user));
            $limiter->clear($this->throttleKey());
        }
        $limiter->hit($this->throttleKey());

    }


    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }

}
