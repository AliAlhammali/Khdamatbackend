<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Requests\Auth;

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
            'z' =>  'required|exists:service_provider_users,phone',
            Rule::exists('otps', 'token')
                ->where('phone', $this->phone),
        ];
    }
}
