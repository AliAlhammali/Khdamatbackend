<?php

namespace App\KhadamatTeck\Base\VOs;

class Location
{
    /**
     * @var numeric $lat
     */
    public $lat;
    /**
     * @var numeric $lng
     */
    public $lng;

    /**
     * @return float|int|string
     */
    public function getLat(): float|int|string
    {
        return $this->lat;
    }

    /**
     * @param float|int|string $lat
     */
    public function setLat(float|int|string $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return float|int|string
     */
    public function getLng(): float|int|string
    {
        return $this->lng;
    }

    /**
     * @param float|int|string $lng
     */
    public function setLng(float|int|string $lng): void
    {
        $this->lng = $lng;
    }


}
