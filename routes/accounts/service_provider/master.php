<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . "/auth.php";
Route::middleware('auth:service-provider')->group(function () {
    require __DIR__ . "/dashboard.php";
    require __DIR__ . "/service-providers.php";
    require __DIR__ . "/service-provider-users.php";
});


