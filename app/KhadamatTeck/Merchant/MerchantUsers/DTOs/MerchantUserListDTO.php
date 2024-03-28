<?php
namespace App\KhadamatTeck\Merchant\MerchantUsers\DTOs;

class MerchantUserListDTO extends MerchantUserDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
