<?php

namespace App\Providers;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {

            return (new MailMessage)
                ->subject('Verify Your Email')
                ->greeting('Hello ' . $notifiable->name . ' 👋')
                ->line('Welcome to Event & Wedding Supplier Management System.')
                ->line('Please verify your email before accessing the system.')
                ->action('Verify Email', $url)
                ->line('Thank you for registering!');
        });
    }
}
