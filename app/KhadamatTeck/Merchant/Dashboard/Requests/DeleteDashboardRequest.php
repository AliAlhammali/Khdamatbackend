<?php
namespace App\KhadamatTeck\Merchant\Dashboard\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class DeleteDashboardRequest extends KhadamatTeckRequest
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
