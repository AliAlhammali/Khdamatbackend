<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class LoginRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:merchant_users,email',
            'password' => 'required'
        ];
    }
}
