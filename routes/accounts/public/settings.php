<?php


use App\KhadamatTeck\Public\Settings\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->controller(SettingsController::class)->group(
    function () {
        Route::get('/{group}', 'list')->whereIn('group',['taxes','general']);
        Route::get('/{group}/{setting}', 'show')->whereIn('group',['taxes','general']);
    }
);// End of settings
