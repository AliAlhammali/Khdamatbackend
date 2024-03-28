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
            'title'=>'required',
            'description'=>'required',
            'address'=>'required',
            'email'=>'required',
            'owner'=>'required'
        ];
    }
}
