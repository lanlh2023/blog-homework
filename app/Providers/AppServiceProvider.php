<?php

namespace App\Providers;

use App\Repositories\RepositoryEloquent\CategoryRepository;
use App\Repositories\RepositoryEloquent\PostRepository;
use App\Repositories\RepositoryEloquent\RoleRepository;
use App\Repositories\RepositoryEloquent\SendMailRepostiory;
use App\Repositories\RepositoryEloquent\UserRepository;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\RepositoryInterface\RoleRepositoryInterface;
use App\Repositories\RepositoryInterface\SendMailRepositoryInterface;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(
            SendMailRepositoryInterface::class,
            SendMailRepostiory::class
        );
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
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
