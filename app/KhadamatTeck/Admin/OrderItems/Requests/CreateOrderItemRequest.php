<?php

namespace App\KhadamatTeck\Admin\OrderItems\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateOrderItemRequest extends KhadamatTeckRequest
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
