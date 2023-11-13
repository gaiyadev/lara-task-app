<?php

namespace App\Listeners;

use App\Events\EmailVerification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationListener
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
        return "{$baseUrl}/verify-email?id={$user->id}&token={$user->verification_token}";
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailVerification $event)
    {
        $user = $event->user;
        $baseUrl = env('FRONTEND_BASE_URL', 'http://localhost');
        $verificationUrl = "{$baseUrl}/verify-email?id={$user->id}&token={$user->verification_token}";
        $verificationUrl = $this->generateVerificationUrl($user);

        $user->notify(new VerifyEmailNotification($verificationUrl));

    }
}
