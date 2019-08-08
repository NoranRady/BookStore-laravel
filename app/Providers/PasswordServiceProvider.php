<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PasswordRepositoryInterface ;
use App\Services\Interfaces\PasswordServiceInterface ;
use App\Services\PasswordService;
class PasswordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Services\Interfaces\PasswordServiceInterface', 'App\Services\PasswordService');
        $this->app->bind('App\Repositories\Interfaces\PasswordRepositoryInterface', 'App\Repositories\PasswordRepository');
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
