<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::get('/figures', [\App\KhadamatTeck\Admin\Dashboard\Controllers\DashboardController::class, 'figures']);
    Route::get('/top_merchants_by_orders', [\App\KhadamatTeck\Admin\Dashboard\Controllers\DashboardController::class, 'top_merchants_by_orders']);
    Route::get('/top_sp_completed_by_orders', [\App\KhadamatTeck\Admin\Dashboard\Controllers\DashboardController::class, 'top_sp_completed_by_orders']);
    Route::get('/top_services', [\App\KhadamatTeck\Admin\Dashboard\Controllers\DashboardController::class, 'top_services']);
    Route::get('/top_categories', [\App\KhadamatTeck\Admin\Dashboard\Controllers\DashboardController::class, 'top_categories']);
});
