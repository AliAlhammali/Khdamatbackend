<?php

use App\KhadamatTeck\Admin\ServiceProviderUsers\Controllers\ServiceProviderUsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('service-provider-users')->group(function () {
    Route::get('/', [ServiceProviderUsersController::class, 'index']);
    Route::post('/create',  [ServiceProviderUsersController::class, 'create']);
    Route::patch('/{id}',  [ServiceProviderUsersController::class, 'update']);
    Route::get('/{id}',  [ServiceProviderUsersController::class, 'show']);
    Route::delete('/{id}',  [ServiceProviderUsersController::class,'delete']);
});
