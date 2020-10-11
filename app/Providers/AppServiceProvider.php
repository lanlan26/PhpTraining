<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\Work\WorkRepositoryInterface;
use App\Repositories\Work\WorkEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Post\PostEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryEloquentRepository::class
        );
        App::bind(WorkRepositoryInterface::class, WorkEloquentRepository::class);
        App::bind(UserRepositoryInterface::class, UserEloquentRepository::class);
        App::bind(PostRepositoryInterface::class, PostEloquentRepository::class);
    }
}
