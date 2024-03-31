<?php

namespace App\KhadamatTeck\Actions\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class UploadActionRequest extends KhadamatTeckRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
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
            'file'  =>  'required',
            'file.*'  =>  'required|file'
        ];
    }
}
