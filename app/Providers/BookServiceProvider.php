<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repositories\Interfaces\BookRepositoryInterface', 'App\Repositories\BookRepository');
        $this->app->bind('App\Services\Interfaces\BookServiceInterface', 'App\Services\BookService');
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
