<?php
use App\KhadamatTeck\Admin\Users\Controllers\AuthController;
use App\KhadamatTeck\Admin\Users\Controllers\UsersController;
use App\KhadamatTeck\Merchant\MerchantUsers\Controllers\MerchantAuthController;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Controllers\ServiceProviderUsersAuthController;
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
    Route::post('logout', [MerchantAuthController::class, 'logout'])->middleware(
        'auth:merchant'
    );

    Route::prefix('me')->middleware('auth:merchant')->group(function () {
        Route::get('/', [MerchantAuthController::class, 'me']);
    });

    Route::post('login', [MerchantAuthController::class, 'login']);
    Route::post('phone-login', [MerchantAuthController::class, 'phoneLogin']);
    Route::post('otp-verify', [MerchantAuthController::class, 'verifyPhoneLogin']);
    //Route::post('register', [MerchantAuthController::class, 'register']);
    Route::post('forgot', [MerchantAuthController::class, 'forgot']);
    Route::post('reset', [MerchantAuthController::class, 'reset']);

    Route::post('login/otp', [MerchantAuthController::class, 'loginWithOTP']);
    Route::post('login/verify', [MerchantAuthController::class, 'verifyWithOTP']);
});


Route::prefix('sp-auth')->group(function () {
    Route::post('logout', [ServiceProviderUsersAuthController::class, 'logout'])->middleware(
        'auth:admin'
    );

    Route::prefix('me')->middleware('auth:service-provider')->group(function () {
        Route::get('/', [ServiceProviderUsersAuthController::class, 'me']);
    });

    Route::post('login', [ServiceProviderUsersAuthController::class, 'login']);
    Route::post('phone-login', [ServiceProviderUsersAuthController::class, 'phoneLogin']);
    Route::post('otp-verify', [ServiceProviderUsersAuthController::class, 'verifyPhoneLogin']);
    //Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot', [ServiceProviderUsersAuthController::class, 'forgot']);
    Route::post('reset', [ServiceProviderUsersAuthController::class, 'reset']);

    Route::post('login/otp', [ServiceProviderUsersAuthController::class, 'loginWithOTP']);
    Route::post('login/verify', [ServiceProviderUsersAuthController::class, 'verifyWithOTP']);
});
