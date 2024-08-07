<?php
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Merchant\Categories\Controllers\CategoriesController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\Merchant\Categories\Controllers\CategoriesController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\Merchant\Categories\Controllers\CategoriesController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\Merchant\Categories\Controllers\CategoriesController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\Merchant\Categories\Controllers\CategoriesController::class, 'delete']);
});
