<?php
namespace App\KhadamatTeck\Base\Http;

class DefaultRequest extends KhadamatTeckRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
