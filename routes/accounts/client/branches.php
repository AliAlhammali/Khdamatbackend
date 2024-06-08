<?php
use Illuminate\Support\Facades\Route;

Route::prefix('branches')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Client\MerchantBranches\Controllers\MerchantBranchesController::class, 'index']);
    Route::get('/{id}', [\App\KhadamatTeck\Client\MerchantBranches\Controllers\MerchantBranchesController::class, 'show']);
});
