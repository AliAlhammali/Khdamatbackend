<?php

namespace App\KhadamatTeck\Base\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\MultiLineString;

class Polygon extends MultiLineString implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        dd($model);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
    }

    public function toWkt(): string
    {
        $wktData = $this->getWktData();

        return "POLYGON({$wktData})";
    }

    public function getWktData(): string
    {
        return $this->geometries
            ->map(static function (LineString $lineString): string {
                $wktData = $lineString->getWktData();

                return "({$wktData})";
            })
            ->join(', ');
    }
}
