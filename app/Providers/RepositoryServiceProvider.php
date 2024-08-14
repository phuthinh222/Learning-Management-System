<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepository',
            'App\Repositories\Eloquent\UserRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Contracts\StudentRepository',
            'App\Repositories\Eloquent\StudentRepositoryEloquent'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
