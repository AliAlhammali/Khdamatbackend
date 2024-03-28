<?php

namespace App\KhadamatTeck\Base;

abstract class IBaseDBSelect
{
    abstract public static function opsListing(): array;


    abstract public static function opsGetById(): array;

// Connect
    abstract public static function connectListing(): array;

    abstract public static function connectGetById(): array;

// Mobile
    abstract public static function mobileListing(): array;

    abstract public static function mobileGetById(): array;
}
