<?php
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::get('/figures', [\App\KhadamatTeck\ServiceProvider\Dashboard\Controllers\DashboardController::class, 'figures']);
    Route::get('/top_staff_by_orders', [\App\KhadamatTeck\ServiceProvider\Dashboard\Controllers\DashboardController::class, 'top_staff_by_orders']);
    Route::get('/top_staff_completed_orders', [\App\KhadamatTeck\ServiceProvider\Dashboard\Controllers\DashboardController::class, 'top_staff_completed_orders']);
    Route::get('/calender_orders', [\App\KhadamatTeck\ServiceProvider\Dashboard\Controllers\DashboardController::class, 'calender_orders']);
});
