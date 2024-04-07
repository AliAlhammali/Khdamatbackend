<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ForgotRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:merchant_users,email',
        ];
    }
}
