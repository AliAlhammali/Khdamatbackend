<?php

namespace App\KhadamatTeck\Admin\Settings\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class ListSettingRequest extends KhadamatTeckRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO check policy
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
