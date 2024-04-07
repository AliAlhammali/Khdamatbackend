<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:service_provider_users,email',
            'token' => 'required|string',
            'password' => [
                'required',
                'string',
                Password::min(12)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ],
        ];

    }
}
