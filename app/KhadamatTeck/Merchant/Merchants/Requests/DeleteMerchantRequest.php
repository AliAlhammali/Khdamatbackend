<?php

namespace App\KhadamatTeck\Merchant\Merchants\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class DeleteMerchantRequest extends KhadamatTeckRequest
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
