<?php
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Admin\Users\Controllers\UsersController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\Admin\Users\Controllers\UsersController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\Admin\Users\Controllers\UsersController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\Admin\Users\Controllers\UsersController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\Admin\Users\Controllers\UsersController::class, 'delete']);
});
