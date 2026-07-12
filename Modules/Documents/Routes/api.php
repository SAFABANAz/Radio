<?php

use Illuminate\Support\Facades\Route;
use Modules\Documents\Http\Controllers\DocumentController;
use Modules\Documents\Http\Controllers\DocumentTypeController;

Route::prefix('api/v1/documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index']);
    Route::post('/', [DocumentController::class, 'store']);
    Route::get('/{document}', [DocumentController::class, 'show']);
    Route::put('/{document}', [DocumentController::class, 'update']);
    Route::delete('/{document}', [DocumentController::class, 'destroy']);
    Route::post('/{document}/download', [DocumentController::class, 'download']);
    Route::post('/{document}/share', [DocumentController::class, 'share']);
    Route::post('/{document}/replace', [DocumentController::class, 'replace']);
});

Route::prefix('api/v1/document-types')->group(function () {
    Route::get('/', [DocumentTypeController::class, 'index']);
    Route::post('/', [DocumentTypeController::class, 'store']);
});
