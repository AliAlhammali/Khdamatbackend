<?php

use App\KhadamatTeck\Admin\ServiceProviders\Controllers\ServiceProvidersController;
use Illuminate\Support\Facades\Route;

Route::prefix('service-providers')->group(function () {
    Route::get('/', [ServiceProvidersController::class, 'index']);
    Route::post('/create',  [ServiceProvidersController::class, 'create']);
    Route::patch('/{id}',  [ServiceProvidersController::class, 'update']);
    Route::get('/{id}',  [ServiceProvidersController::class, 'show']);
    Route::delete('/{id}',  [ServiceProvidersController::class,'delete']);
});
