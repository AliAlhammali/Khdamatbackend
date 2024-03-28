<?php
namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateServiceProviderUserRequest extends KhadamatTeckRequest
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
