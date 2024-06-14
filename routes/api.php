<?php

use App\KhadamatTeck\Actions\Controller\UploadAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {


    require __DIR__ . "/accounts/authMaster.php";

    Route::prefix('admin')->middleware('auth:admin')->group(function () {
        require __DIR__ . "/accounts/admin/master.php";
    });
    Route::prefix('merchant')->group(function () {
        require __DIR__ . "/accounts/merchant/master.php";
    });
    Route::prefix('client')->group(function () {
        require __DIR__ . "/accounts/client/master.php";
    });
    Route::prefix('service-provider')->group(function () {
        require __DIR__ . "/accounts/service_provider/master.php";
    });

    Route::prefix('actions')->group(function () {
        Route::post('upload', UploadAction::class);
    });

        // public
    Route::prefix('/public')->group(function () {
        require __DIR__ . "/accounts/public/master.php";
    });

});
