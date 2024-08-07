<?php
use Illuminate\Support\Facades\Route;

Route::prefix('merchants')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Admin\Merchants\Controllers\MerchantsController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\Admin\Merchants\Controllers\MerchantsController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\Admin\Merchants\Controllers\MerchantsController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\Admin\Merchants\Controllers\MerchantsController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\Admin\Merchants\Controllers\MerchantsController::class, 'delete']);
});
