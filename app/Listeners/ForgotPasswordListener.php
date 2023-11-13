<?php

namespace App\Listeners;

use App\Notifications\ForgotPasswordNotification;
use App\Helpers\UrlHelper;

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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $resetPasswordUrl = UrlHelper::generateVerificationUrl($user, 'reset');
        $user->notify(new ForgotPasswordNotification($resetPasswordUrl));
    }
}
