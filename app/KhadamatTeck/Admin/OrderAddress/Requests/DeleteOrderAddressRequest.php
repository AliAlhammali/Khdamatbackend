<?php
namespace App\KhadamatTeck\Admin\OrderAddress\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class DeleteOrderAddressRequest extends KhadamatTeckRequest
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
