<?php

namespace App\KhadamatTeck\Admin\Users\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateProfileRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes',
            'email' => 'sometimes|email|unique:users,email,' . $this->id,
            'phone' => 'sometimes|unique:users,phone,' . $this->id,
        ];
    }
}
