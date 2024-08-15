<?php

namespace App\Jobs;

use App\Mail\Auth\ResetPassword;
use App\Models\UserManagement\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetUserPasswordJob
{
    use Dispatchable;


    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = \Str::uuid();
        $now = now()->toDateTimeString();
        $token = hash_hmac('sha256', $token, config('app.key'));

        Mail::to($this->user->owner->email)->send(new ResetPassword($this->user , $token ,$now));
        DB::table('password_reset_tokens')->where('email', $this->user->owner->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $this->user->owner->email,
            'token' => $token,
            'created_at' => $now,
        ]);
    }
}
