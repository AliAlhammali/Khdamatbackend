<?php
use Illuminate\Support\Facades\Route;

Route::prefix('branches')->group(function () {
    Route::get('/', [\App\KhadamatTeck\Merchant\MerchantBranches\Controllers\MerchantBranchesController::class, 'index']);
    Route::post('/create', [\App\KhadamatTeck\Merchant\MerchantBranches\Controllers\MerchantBranchesController::class, 'create']);
    Route::patch('/{id}', [\App\KhadamatTeck\Merchant\MerchantBranches\Controllers\MerchantBranchesController::class, 'update']);
    Route::get('/{id}', [\App\KhadamatTeck\Merchant\MerchantBranches\Controllers\MerchantBranchesController::class, 'show']);
    Route::delete('/{id}', [\App\KhadamatTeck\Merchant\MerchantBranches\Controllers\MerchantBranchesController::class, 'delete']);
});
