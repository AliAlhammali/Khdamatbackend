<?php


use App\KhadamatTeck\Public\Settings\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->controller(SettingsController::class)->group(
    function () {
        Route::get('/{group}', 'list');
        Route::get('/{group}/{setting}', 'show');
    }
);// End of settings
