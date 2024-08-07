<?php
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Client\Categories\Controllers\CategoriesController::class, 'index']);
    Route::get('/{id}', [\App\KhadamatTeck\Client\Categories\Controllers\CategoriesController::class, 'show']);
});
