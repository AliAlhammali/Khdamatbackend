<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Validation\Rule;


class VerifyPhoneLogin extends KhadamatTeckRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'z' =>  'required|exists:merchant_users,phone',
            Rule::exists('otps', 'token')
                ->where('phone', $this->phone),
        ];
    }
}
