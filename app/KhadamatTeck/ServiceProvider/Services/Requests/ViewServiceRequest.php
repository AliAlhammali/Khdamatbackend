<?php

namespace App\KhadamatTeck\ServiceProvider\Services\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewServiceRequest extends KhadamatTeckRequest
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
