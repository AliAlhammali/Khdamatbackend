<?php

use App\KhadamatTeck\Merchant\MerchantUsers\Controllers\MerchantUsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchant-users')->group(function () {
    Route::get('/', [MerchantUsersController::class, 'index']);
    Route::post('/create', [MerchantUsersController::class, 'create']);
    Route::patch('/{id}', [MerchantUsersController::class, 'update']);
    Route::get('/{id}', [MerchantUsersController::class, 'show']);
    Route::delete('/{id}', [MerchantUsersController::class, 'delete']);
});
