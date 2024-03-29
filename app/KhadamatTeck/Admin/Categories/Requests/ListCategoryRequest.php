<?php
namespace App\KhadamatTeck\Admin\Categories\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ListCategoryRequest extends KhadamatTeckRequest
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
