<?php

namespace App\Providers;

use App\Repository\BuyerRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Service\BuyerService;
use App\Service\CategoryService;
use App\Service\ProductService;
use App\Service\SellerService;
use App\Service\TransactionService;
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
        $this->app->bind(CategoryService::class,CategoryRepository::class);
        $this->app->bind(ProductService::class,ProductRepository::class);
        $this->app->bind(TransactionService::class,TransactionRepository::class);
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
