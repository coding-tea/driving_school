<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    /***
     *
     * @return
     */
    public function index(Request $request)
    {
        $tokenRow = DB::table('password_reset_tokens')->where('token', $request->route('token'))->first();
        if ($tokenRow == null) {
            abort(403);
        }

        $createdAt = Carbon::parse($tokenRow->created_at);
        $expires_at = $createdAt->addMinutes(config('auth.passwords.users.expire'));
        if ($tokenRow == null || !now()->between($tokenRow->created_at, $expires_at->toDateTimeString())) {
            abort(403);
        }
        $this->setPageTitle(trans('auth.reset_password'));
        return view('pages.auth.reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
            'expires_at' => $expires_at->toDateTimeString(),
        ]);
    }

    /***
     *
     * @return
     */
    public function performResetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $tokenRow = DB::table('password_reset_tokens')->where('token', $validated['token'])->first();


        if ($tokenRow->email != $validated['email']) {
            throw ValidationException::withMessages([
                'email' => [trans('passwords.user')],
            ]);
        }
        $colab = Collaborator::query()->where("email", $validated['email'])->first();
        $accont = $colab->account;
        $accont->update([
            'password' => Hash::make($validated['password'])
        ]);

        DB::table('password_reset_tokens')->where('token', $validated['token'])->delete();
        $this->success(trans('app.done'), trans('auth.reset_password_success'));
        return redirect(route('login::view'));


    }
}
