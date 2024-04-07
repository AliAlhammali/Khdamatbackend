<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Requests\Auth;

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
            'email' => 'required|email|exists:service_provider_users,email',
            'password' => 'required'
        ];
    }
}
