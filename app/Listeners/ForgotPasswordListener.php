<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Notifications\ForgotPasswordNotification;

class ForgotPasswordListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of generateVerificationUrl
     * @param mixed $user
     * @return string
     */
    private function generateVerificationUrl($user)
    {
        $baseUrl = env('FRONTEND_BASE_URL', 'http://localhost');
        return "{$baseUrl}/forgot-password?id={$user->id}&token={$user->verification_token}";
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $baseUrl = env('FRONTEND_BASE_URL', 'http://localhost');
        $verificationUrl = "{$baseUrl}/verify-email?id={$user->id}&token={$user->verification_token}";
        $verificationUrl = $this->generateVerificationUrl($user);
        $user->notify(new ForgotPasswordNotification($verificationUrl));
    }
}
