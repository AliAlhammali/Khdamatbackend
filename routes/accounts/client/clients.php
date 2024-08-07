<?php
use Illuminate\Support\Facades\Route;

Route::prefix('clients')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Merchant\MerchantClients\Controllers\MerchantClientsController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\Merchant\MerchantClients\Controllers\MerchantClientsController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\Merchant\MerchantClients\Controllers\MerchantClientsController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\Merchant\MerchantClients\Controllers\MerchantClientsController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\Merchant\MerchantClients\Controllers\MerchantClientsController::class, 'delete']);
});
