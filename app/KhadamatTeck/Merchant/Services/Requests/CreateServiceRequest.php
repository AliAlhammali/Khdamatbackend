<?php

namespace App\KhadamatTeck\Merchant\Services\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateServiceRequest extends KhadamatTeckRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }
}
