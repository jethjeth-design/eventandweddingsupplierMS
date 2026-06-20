<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $messageContent;

    public function __construct($user, $messageContent)
    {
        $this->user = $user;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Welcome to Event & Wedding Supplier System')
                    ->view('emails.custom');
    }
}