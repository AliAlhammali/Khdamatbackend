<?php
namespace App\KhadamatTeck\Merchant\Categories\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewCategoryRequest extends KhadamatTeckRequest
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
