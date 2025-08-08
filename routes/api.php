<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityStateController;
use App\Http\Controllers\Api\FollowingController;
#auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send-otp', [AuthController::class, 'sendOTP']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

#user
Route::resource('users', App\Http\Controllers\Api\UserController::class)->only(['index', 'show', 'destroy']);
Route::post('/users/complete-profile', [App\Http\Controllers\Api\UserController::class, 'completeProfile']);
#