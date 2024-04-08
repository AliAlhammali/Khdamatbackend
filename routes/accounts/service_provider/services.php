<?php
use Illuminate\Support\Facades\Route;

Route::prefix('services')->group(function () {
    Route::get('/', [\App\KhadamatTeck\ServiceProvider\Services\Controllers\ServicesController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\ServiceProvider\Services\Controllers\ServicesController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\ServiceProvider\Services\Controllers\ServicesController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\ServiceProvider\Services\Controllers\ServicesController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\ServiceProvider\Services\Controllers\ServicesController::class, 'delete']);
});
