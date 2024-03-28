<?php
namespace App\KhadamatTeck\Admin\ServiceProviders\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateServiceProviderRequest extends KhadamatTeckRequest
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
