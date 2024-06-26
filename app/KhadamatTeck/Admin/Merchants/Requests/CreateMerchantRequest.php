<?php

namespace App\KhadamatTeck\Admin\Merchants\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class CreateMerchantRequest extends KhadamatTeckRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => 'required',
            "phone" => 'required',
            "email" => 'required|email',
            "address" => 'required',
            "owner" => 'required|array',
            "owner.name" => 'required',
            "owner.email" => 'required|email',
            'vat_file' => 'required',
            'cr_file' => 'required',
            'sales_agreement_file' => 'required',
            'cr_number' => 'required',
            'vat_number' => 'required',
        ];
    }
}
