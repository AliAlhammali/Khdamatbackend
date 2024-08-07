<?php

namespace App\KhadamatTeck\Admin\OrderAddress\DTOs;

class OrderAddressListDTO extends OrderAddressDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
