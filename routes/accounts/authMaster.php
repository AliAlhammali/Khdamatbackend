<?php
use App\KhadamatTeck\Admin\Users\Controllers\AuthController;
use App\KhadamatTeck\Admin\Users\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin-auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware(
        'auth:admin'
    );

    Route::prefix('me')->middleware('auth:admin')->group(function () {
        Route::get('/', [AuthController::class, 'me']);
        Route::put('update', [UsersController::class, 'update']);
    });

    Route::post('login', [AuthController::class, 'login']);
    Route::post('phone-login', [AuthController::class, 'phoneLogin']);
    Route::post('otp-verify', [AuthController::class, 'verifyPhoneLogin']);
    //Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot', [AuthController::class, 'forgot']);
    Route::post('reset', [AuthController::class, 'reset']);

    Route::post('login/otp', [AuthController::class, 'loginWithOTP']);
    Route::post('login/verify', [AuthController::class, 'verifyWithOTP']);
});


Route::prefix('merchant-auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware(
        'auth:merchant'
    );

    Route::prefix('me')->middleware('auth:merchant')->group(function () {
        Route::get('/', [AuthController::class, 'me']);
    });

    Route::post('login', [AuthController::class, 'login']);
    Route::post('phone-login', [AuthController::class, 'phoneLogin']);
    Route::post('otp-verify', [AuthController::class, 'verifyPhoneLogin']);
    //Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot', [AuthController::class, 'forgot']);
    Route::post('reset', [AuthController::class, 'reset']);

    Route::post('login/otp', [AuthController::class, 'loginWithOTP']);
    Route::post('login/verify', [AuthController::class, 'verifyWithOTP']);
});


Route::prefix('sp-auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware(
        'auth:admin'
    );

    Route::prefix('me')->middleware('auth:admin')->group(function () {
        Route::get('/', [AuthController::class, 'me']);
    });

    Route::post('login', [AuthController::class, 'login']);
    Route::post('phone-login', [AuthController::class, 'phoneLogin']);
    Route::post('otp-verify', [AuthController::class, 'verifyPhoneLogin']);
    //Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot', [AuthController::class, 'forgot']);
    Route::post('reset', [AuthController::class, 'reset']);

    Route::post('login/otp', [AuthController::class, 'loginWithOTP']);
    Route::post('login/verify', [AuthController::class, 'verifyWithOTP']);
});
