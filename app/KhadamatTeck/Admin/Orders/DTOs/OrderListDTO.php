<?php

namespace App\KhadamatTeck\Admin\Orders\DTOs;

class OrderListDTO extends OrderDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
