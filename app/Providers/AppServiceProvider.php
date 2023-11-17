<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\RepositoryEloquent\UserRepository;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\RepositoryEloquent\PostRepository;
use App\Repositories\RepositoryEloquent\RoleRepository;
use App\Repositories\RepositoryInterface\RoleRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        $this->app->singleton(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
