<?php

namespace App\KhadamatTeck\Base\Http;

use Illuminate\Foundation\Http\FormRequest;
use App\KhadamatTeck\Base\RequestValidator;

abstract class KhadamatTeckRequest extends FormRequest
{
    use RequestValidator;

    public function authorize()
    {
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
