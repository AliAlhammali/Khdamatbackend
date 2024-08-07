<?php

namespace App\KhadamatTeck\Base;

class AppEnums extends BaseEnum
{
    public const WALLET_TYPE_UNLIMITED = 1;
    public const WALLET_TYPE_RESTRICTED = 2;

    static function setHumanizedConstants(): void
    {
        self::$humanizedConstants = [
            self::WALLET_TYPE_UNLIMITED => "Unlimited",
            self::WALLET_TYPE_RESTRICTED => "Restricted",
        ];
    }
}
