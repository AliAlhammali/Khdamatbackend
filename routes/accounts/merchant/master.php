<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//require __DIR__ . "/auth.php";
Route::middleware('auth:merchant')->group(function () {
    require __DIR__ . "/dashboard.php";
    require __DIR__ . "/merchants.php";
    require __DIR__ . "/merchant-users.php";
    require __DIR__ . "/categories.php";
    require __DIR__ . "/services.php";
    require __DIR__ . "/branches.php";
    require __DIR__ . "/clients.php";
    require __DIR__ . "/orders.php";
});


