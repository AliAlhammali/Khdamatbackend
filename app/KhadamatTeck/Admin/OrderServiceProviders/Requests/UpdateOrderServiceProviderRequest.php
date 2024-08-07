<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateOrderServiceProviderRequest extends KhadamatTeckRequest
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
