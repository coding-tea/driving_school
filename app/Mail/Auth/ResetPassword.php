<?php

namespace App\Mail\Auth;

use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;


    public User $user;
    public string $url;
    public string $expires_at;

    /**
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user , string $token , public string $token_created_at)
    {

        $this->user = $user;
        $this->url = route('reset-password::view',[
            'token' => $token,
            'email' => $this->user->owner->email,
        ]);

        $this->expires_at = Carbon::parse($this->token_created_at)->addMinutes(config('auth.passwords.users.expire'))->toDateTimeString();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.auth.reset-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
