<?php

namespace App\Listeners;

use App\Events\EmailVerification;
use App\Notifications\VerifyEmailNotification;
use App\Helpers\UrlHelper;

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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailVerification $event)
    {
        $user = $event->user;
        $verificationUrl = UrlHelper::generateVerificationUrl($user);

        $user->notify(new VerifyEmailNotification($verificationUrl));
    }
}
