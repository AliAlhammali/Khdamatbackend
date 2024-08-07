<?php

namespace App\KhadamatTeck\Admin\OrderItems\DTOs;

class OrderItemListDTO extends OrderItemDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
