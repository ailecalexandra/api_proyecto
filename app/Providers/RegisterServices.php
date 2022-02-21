<?php

namespace App\Providers;

use App\Repository\UserRepository;
use App\Service\UserService;
use Illuminate\Support\ServiceProvider;

class RegisterServices extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class,UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
