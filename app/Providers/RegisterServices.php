<?php

namespace App\Providers;

use App\Repository\BuyerRepository;
use App\Repository\SellerRepository;
use App\Repository\UserRepository;
use App\Service\BuyerService;
use App\Service\SellerService;
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
        $this->app->bind(UserService::class, UserRepository::class);
        $this->app->bind(SellerService::class, SellerRepository::class);
        $this->app->bind(BuyerService::class,BuyerRepository::class);
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
