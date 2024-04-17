<?php

namespace App\KhadamatTeck\Base\Http;

use App\KhadamatTeck\Base\RequestValidator;
use Illuminate\Foundation\Http\FormRequest;

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
