<?php

namespace App\KhadamatTeck\Admin\OrderTotals\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateOrderTotalRequest extends KhadamatTeckRequest
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
