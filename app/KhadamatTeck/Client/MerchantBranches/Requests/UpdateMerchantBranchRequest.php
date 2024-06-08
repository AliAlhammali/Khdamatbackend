<?php

namespace App\KhadamatTeck\Client\MerchantBranches\Requests;

use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;

class UpdateMerchantBranchRequest extends KhadamatTeckRequest
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
    protected function passedValidation()
    {
        if ($this->has('location')) {
            $location = $this->get('location');
            $locationPoint = new Point($location['lat'], $location['long'], Srid::WGS84->value);
            $this->merge(['location' => $locationPoint]);
        }
        $this->merge(['merchant_id' => MerchantAuth()->id()]);
    }
}
