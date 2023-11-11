<?php

namespace App\Providers;
use App\Repositories\AuthRepositoryInterface;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(AuthRepository::class);
        $this->app->singleton(AuthRepositoryInterface::class, AuthRepository::class);

        // $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
