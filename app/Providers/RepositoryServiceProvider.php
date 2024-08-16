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
            'App\Repositories\Contracts\StudentRepository',
            'App\Repositories\Eloquent\StudentRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Contracts\SubjectRepository',
            'App\Repositories\Eloquent\SubjectRepositoryEloquent',
        );
        $this->app->bind(
            'App\Repositories\Contracts\AttendancesRepository',
            'App\Repositories\Eloquent\AttendancesRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Contracts\AttendanceTeachersRepository',
            'App\Repositories\Eloquent\AttendanceTeachersRepositoryEloquent'
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
