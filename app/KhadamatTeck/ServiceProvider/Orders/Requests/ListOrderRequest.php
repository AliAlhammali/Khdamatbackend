<?php

namespace App\KhadamatTeck\ServiceProvider\Orders\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ListOrderRequest extends KhadamatTeckRequest
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
