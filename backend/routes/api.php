<?php

use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(LoginRegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

//CategoryController
Route::get('/categories', [CategoryController::class, 'categories']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::resource('feedback', FeedBackController::class);
    Route::post('/AddComment', [FeedBackController::class, 'AddComment']);

    Route::get('/getmentionuser', [UserController::class, 'getmentionuser']);
});
