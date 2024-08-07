<?php
use Illuminate\Support\Facades\Route;

Route::prefix('services')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Client\Services\Controllers\ServicesController::class, 'index']);
    Route::get('/{id}', [\App\KhadamatTeck\Client\Services\Controllers\ServicesController::class, 'show']);
});
