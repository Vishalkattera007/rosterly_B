<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

// 🔹 OAuth Authentication Routes (Laravel Passport)
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])->middleware('throttle');
Route::post('/oauth/token/refresh', [TransientTokenController::class, 'refresh']);

// 🔹 Admin Authentication
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('login');

// 🔹 Protected Routes (Require Authentication)
// Route::middleware('auth:api')->group(function () {

    // 🛑 Admin Management Routes
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/{id?}', [AdminController::class, 'index']);
        Route::post('/', [AdminController::class, 'create']);
        Route::put('/{id}', [AdminController::class, 'update']);
        Route::delete('/{id}', [AdminController::class, 'delete']);
    });

    // 🏢 Location Management Routes
    Route::prefix('location')->group(function () {
        Route::get('/{id?}', [LocationController::class, 'index']);
        Route::post('/', [LocationController::class, 'create']);
        Route::put('/{id}', [LocationController::class, 'update']);
        Route::delete('/{id}', [LocationController::class, 'delete']);
    });

    // 👨‍💼 Employee Management Routes
    Route::prefix('employee')->group(function () {
        Route::get('/{id?}', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'create']);
        Route::put('/{id}', [EmployeeController::class, 'update']);
        Route::delete('/{id}', [EmployeeController::class, 'delete']);
    });
// });
