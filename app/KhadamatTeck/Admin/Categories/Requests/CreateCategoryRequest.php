<?php

namespace App\KhadamatTeck\Admin\Categories\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateCategoryRequest extends KhadamatTeckRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'sometimes|nullable'
        ];
    }
}
