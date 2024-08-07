<?php

namespace App\KhadamatTeck\Admin\Users\Requests\Auth;

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
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
}
