<?php

namespace App\KhadamatTeck\Admin\OrderTotals\DTOs;

class OrderTotalListDTO extends OrderTotalDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
