<?php

use App\KhadamatTeck\Client\Orders\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->group(function () {
    Route::get('/', [OrdersController::class, 'index']);
    Route::post('/create', [OrdersController::class, 'create']);
//    Route::patch('/{id}', [OrdersController::class, 'update']);
    Route::get('/{id}', [OrdersController::class, 'show']);
//    Route::delete('/{id}', [OrdersController::class, 'delete']);
});
