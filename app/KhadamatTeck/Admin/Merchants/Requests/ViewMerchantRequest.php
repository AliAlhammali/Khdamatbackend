<?php
namespace App\KhadamatTeck\Admin\Merchants\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewMerchantRequest extends KhadamatTeckRequest
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
