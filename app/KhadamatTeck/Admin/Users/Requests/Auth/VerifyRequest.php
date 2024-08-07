<?php

namespace App\KhadamatTeck\Admin\Users\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class VerifyRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'code' => 'required'
        ];
    }
}
