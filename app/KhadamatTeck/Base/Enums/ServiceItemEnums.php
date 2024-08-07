<?php

namespace App\KhadamatTeck\Base\Enums;

use App\KhadamatTeck\Base\BaseEnum;

class ServiceItemEnums extends BaseEnum
{
    public const service_item_endpoint = 'ops';

    static function setHumanizedConstants(): void
    {
        self::$humanizedConstants = [
            self::service_item_endpoint => "OPs",
        ];
    }
}
