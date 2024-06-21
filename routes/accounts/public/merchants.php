<?php
use Illuminate\Support\Facades\Route;

Route::prefix('merchants')->group(function () {
    Route::get('/{code}', [\App\KhadamatTeck\Public\Merchants\Controllers\MerchantsController::class, 'getByCode']);
});
