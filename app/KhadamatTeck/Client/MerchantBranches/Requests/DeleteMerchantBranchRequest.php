<?php

namespace App\KhadamatTeck\Client\MerchantBranches\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class DeleteMerchantBranchRequest extends KhadamatTeckRequest
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
