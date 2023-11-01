<?php

use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\ProductController;
use App\Http\Controllers\API\v1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        Route::controller(UserController::class)->group(function() {
            Route::get('users', 'index');
            Route::post('users', 'store');
            Route::get('users/{id}', 'show');
            Route::patch('users/{id}', 'update');
            Route::delete('users/{id}', 'destroy');
        });
        
        Route::controller(ProductController::class)->group(function() {
            Route::get('products', 'index');
            Route::post('products', 'store');
            Route::get('products/{id}', 'show');
            Route::patch('products/{id}', 'update');
            Route::delete('products/{id}', 'destroy');
        });
    });

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });
});
