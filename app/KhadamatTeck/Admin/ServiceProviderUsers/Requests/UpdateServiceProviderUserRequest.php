<?php
namespace App\KhadamatTeck\Admin\ServiceProviderUsers\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateServiceProviderUserRequest extends KhadamatTeckRequest
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
