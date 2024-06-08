<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//require __DIR__ . "/auth.php";
Route::middleware('auth:client')->group(function () {
    require __DIR__ . "/dashboard.php";
    require __DIR__ . "/categories.php";
    require __DIR__ . "/services.php";
    require __DIR__ . "/clients.php";
    require __DIR__ . "/orders.php";
});


