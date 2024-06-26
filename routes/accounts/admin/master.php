<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([],function () {
    require __DIR__ . "/dashboard.php";
    require __DIR__ . "/users.php";
    require __DIR__ . "/merchants.php";
    require __DIR__ . "/merchant-users.php";
    require __DIR__ . "/service-providers.php";
    require __DIR__ . "/service-provider-users.php";
    require __DIR__ . "/categories.php";
    require __DIR__ . "/services.php";
    require __DIR__ . "/orders.php";
    require __DIR__ . "/settings.php";
});


