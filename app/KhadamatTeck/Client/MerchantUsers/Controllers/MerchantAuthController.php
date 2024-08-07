<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\ForgotRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\LoginRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\PhoneLoginRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\RegisterRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\ResetPasswordRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\VerifyPhoneLogin;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth\VerifyRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Services\AuthService;
use Illuminate\Validation\ValidationException;


class MerchantAuthController extends Controller
{
    /**
     * @var AuthService $authService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->registerUser($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->loginUser($request);
    }

    public function loginWithOTP(LoginRequest $request)
    {
        return $this->authService->loginUserWithOTP($request);
    }

    public function verifyWithOTP(LoginRequest $request)
    {
        return $this->authService->verifyLoginUserWithOTP($request);
    }

    public function phoneLogin(PhoneLoginRequest $request)
    {
        return $this->authService->phoneLoginUser($request);
    }

    public function verifyPhoneLogin(VerifyPhoneLogin $request)
    {
        return $this->authService->verifyPhoneLoginUser($request);
    }

    public function forgot(ForgotRequest $request)
    {
        return $this->authService->forgotPassword($request);
    }

    public function verify(VerifyRequest $request)
    {
    }

    public function reset(ResetPasswordRequest $request)
    {
        return $this->authService->resetPassword($request);
    }

    /**
     * @throws ValidationException
     */
    public function me()
    {
        return $this->authService->loggedInUser();
    }
}
