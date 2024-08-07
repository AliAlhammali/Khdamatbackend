<?php

namespace App\KhadamatTeck\Client\MerchantClients\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ListMerchantClientRequest extends KhadamatTeckRequest
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
