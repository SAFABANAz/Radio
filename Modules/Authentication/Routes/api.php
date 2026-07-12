<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\AuthenticationController;

Route::prefix('api/v1/auth')->group(function () {
    Route::post('/otp/request', [AuthenticationController::class, 'requestOtp']);
    Route::post('/otp/verify', [AuthenticationController::class, 'verifyOtp']);
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
});
