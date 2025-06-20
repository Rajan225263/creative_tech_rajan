<?php

namespace App\Providers;

use App\Repositories\ProductRepository\ProductRepositoryContact;
use App\Repositories\ProductRepository\ProductRepository;

use App\Repositories\CategoryRepository\CategoryRepositoryContact;
use App\Repositories\CategoryRepository\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(ProductRepositoryContact::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryContact::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
