<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewMerchantUserRequest extends KhadamatTeckRequest
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
