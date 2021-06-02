<?php

namespace App\Providers;


use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use App\Repositories\DbOrderRepository;
use App\Repositories\DbProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, DbProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, DbOrderRepository::class);
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
