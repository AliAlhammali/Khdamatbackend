<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class RegisterRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' =>  'required|email|unique:users',
            'password' =>  'required',
            'phone' => 'required|unique:users',
        ];
    }
}
