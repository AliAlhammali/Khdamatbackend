<?php
namespace App\KhadamatTeck\ServiceProvider\Categories\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateCategoryRequest extends KhadamatTeckRequest
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
