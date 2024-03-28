<?php
namespace App\KhadamatTeck\Admin\Users\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewUserRequest extends KhadamatTeckRequest
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
