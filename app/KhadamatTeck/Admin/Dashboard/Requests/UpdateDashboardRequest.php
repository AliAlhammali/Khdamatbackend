<?php
namespace App\KhadamatTeck\Admin\Dashboard\Requests;

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
