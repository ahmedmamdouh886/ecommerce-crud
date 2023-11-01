<?php

namespace App\Providers;

use App\Http\Controllers\API\v1\ProductController;
use App\Http\Controllers\API\v1\UserController;
use App\Repository\Interface\RepoInterface;
use App\Repository\ProductRepo;
use App\Repository\UserRepo;
use App\Services\Auth\UserAuth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repository interface with User repository when UserController or UserAuth consumed.
        $this->app->when([UserController::class, UserAuth::class])
          ->needs(RepoInterface::class)
          ->give(function () {
              return $this->app->make(UserRepo::class);
          });
        
        // Bind Repository interface with product repository when ProductController consumed.
        $this->app->when(ProductController::class)
          ->needs(RepoInterface::class)
          ->give(function () {
              return $this->app->make(ProductRepo::class);
          });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
