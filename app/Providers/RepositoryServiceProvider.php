<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        // $this->app->singleton(AuthRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }
}
?>