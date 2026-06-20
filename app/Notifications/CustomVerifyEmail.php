<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Email')
            ->view('emails.custom', [
                'url' => $verificationUrl,
                'user' => $notifiable,
                'messageContent' => 'Please verify your email account.',
            ]);
    }
}