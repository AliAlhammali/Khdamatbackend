<?php
namespace App\KhadamatTeck\ServiceProvider\Orders\DTOs;

class OrderListDTO extends OrderDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
