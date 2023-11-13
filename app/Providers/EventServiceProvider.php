<?php

namespace App\Providers;

use App\Events\EmailVerification;
use App\Events\ForgotPassword;
use App\Listeners\EmailVerificationListener;
use App\Listeners\ForgotPasswordListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EmailVerification::class => [
            EmailVerificationListener::class
        ],
        ForgotPassword::class => [
            ForgotPasswordListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
