<?php
namespace App\KhadamatTeck\Merchant\Orders\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class DeleteOrderRequest extends KhadamatTeckRequest
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
