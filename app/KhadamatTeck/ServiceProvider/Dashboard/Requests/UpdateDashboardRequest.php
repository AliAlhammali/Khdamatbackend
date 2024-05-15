<?php
namespace App\KhadamatTeck\ServiceProvider\Dashboard\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UpdateDashboardRequest extends KhadamatTeckRequest
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
