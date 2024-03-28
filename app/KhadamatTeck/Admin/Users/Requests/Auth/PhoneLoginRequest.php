<?php

namespace App\KhadamatTeck\Admin\Users\Requests\Auth;

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
            'phone' =>  'required|exists:users,phone',
        ];
    }
}
