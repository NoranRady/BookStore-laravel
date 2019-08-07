<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Services\Interfaces\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Repositories\Interfaces\UserRepositoryInterface', 'App\Repositories\UserRepository');
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
