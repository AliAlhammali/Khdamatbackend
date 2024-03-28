<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . "/auth.php";
Route::middleware('auth:admin')->group(function () {
    require __DIR__ . "/dashboard.php";
    require __DIR__ . "/merchants.php";
    require __DIR__ . "/merchant-users.php";
    require __DIR__ . "/service-providers.php";
    require __DIR__ . "/service-provider-users.php";
});


