<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class PhoneLoginRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|exists:service_provider_users,phone',
        ];
    }
}
