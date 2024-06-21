<?php


use App\KhadamatTeck\Admin\Settings\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->controller(SettingsController::class)->group(
    function () {
        Route::get('/{group}', 'list');
        Route::get('/{group}/{setting}', 'show');
        Route::patch('update/{group}', 'update');
        Route::post('forget/{group?}/{key?}', 'forget');
    }
);// End of settings
