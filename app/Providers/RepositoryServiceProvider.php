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
            'App\Repositories\Eloquent\UserRepositoryEloquent',
        );
        $this->app->bind(
            'App\Repositories\Contracts\TeacherRepository',
            'App\Repositories\Eloquent\TeacherRepositoryEloquent',
        );
        $this->app->bind(
            'App\Repositories\Contracts\ExperienceRepository',
            'App\Repositories\Eloquent\ExperienceRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Contracts\CertificateRepository',
            'App\Repositories\Eloquent\CertificateRepositoryEloquent'
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
