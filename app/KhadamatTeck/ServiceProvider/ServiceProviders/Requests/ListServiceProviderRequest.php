<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ListServiceProviderRequest extends KhadamatTeckRequest
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
