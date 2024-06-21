<?php

namespace App\KhadamatTeck\Client\MerchantClients\Requests\Auth;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;

class RegisterRequest extends KhadamatTeckRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required|unique:merchant_clients',
            'address' => 'required',
            'location' => 'required',
            'merchant_id' => 'required|exists:merchants,id',
        ];
    }

    protected function passedValidation()
    {
        if ($this->has('location')) {
            $location = $this->get('location');
            $locationPoint = new Point($location['lat'], $location['long'], Srid::WGS84->value);
            $this->merge(['location' => $locationPoint]);
        }
    }
}
