<?php

namespace App\KhadamatTeck\Client\Services\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateServiceRequest extends KhadamatTeckRequest
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
