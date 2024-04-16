<?php
namespace App\KhadamatTeck\Admin\MerchantBranches\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ViewMerchantBranchRequest extends KhadamatTeckRequest
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
