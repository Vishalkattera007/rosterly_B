<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('/{id?}',[AdminController::class, 'index']);
    Route::post('/',[AdminController::class, 'create']);
    Route::put('/{id?}',[AdminController::class, 'update']);
    Route::delete('/{id?}',[AdminController::class, 'delete']);
});

Route::prefix('location')->group(function(){
    Route::get('/{id?}',[LocationController::class, 'index']);
    Route::post('/',[LocationController::class, 'create']);
    Route::put('/{id?}',[LocationController::class, 'update']);
    Route::delete('/{id?}',[LocationController::class, 'delete']);
});

Route::prefix('employee')->group(function(){
    Route::get('/{id?}',[EmployeeController::class, 'index']);
    Route::post('/',[EmployeeController::class, 'create']);
    Route::put('/{id?}',[EmployeeController::class, 'update']);
    Route::delete('/{id?}',[EmployeeController::class, 'delete']);
});




