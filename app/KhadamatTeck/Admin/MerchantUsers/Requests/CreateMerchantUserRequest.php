<?php
namespace App\KhadamatTeck\Admin\MerchantUsers\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateMerchantUserRequest extends KhadamatTeckRequest
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
