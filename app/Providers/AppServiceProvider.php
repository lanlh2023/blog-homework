<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\RepositoryEloquent\UserRepository;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\RepositoryEloquent\PostRepository;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
