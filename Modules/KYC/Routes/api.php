<?php

use Illuminate\Support\Facades\Route;
use Modules\KYC\Http\Controllers\KycRequestController;

Route::prefix('api/v1/kyc')->group(function () {
    Route::get('/', [KycRequestController::class, 'index']);
    Route::post('/', [KycRequestController::class, 'store']);
    Route::get('/{kycRequest}', [KycRequestController::class, 'show']);
    Route::put('/{kycRequest}', [KycRequestController::class, 'update']);
    Route::post('/{kycRequest}/submit', [KycRequestController::class, 'submit']);
    Route::post('/{kycRequest}/approve', [KycRequestController::class, 'approve']);
    Route::post('/{kycRequest}/reject', [KycRequestController::class, 'reject']);
    Route::post('/{kycRequest}/profile', [KycRequestController::class, 'saveProfile']);
});
