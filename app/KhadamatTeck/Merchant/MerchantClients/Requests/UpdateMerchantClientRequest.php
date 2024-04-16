<?php
namespace App\KhadamatTeck\Merchant\MerchantClients\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateMerchantClientRequest extends KhadamatTeckRequest
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
