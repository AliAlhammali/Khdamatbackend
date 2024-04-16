<?php
namespace App\KhadamatTeck\Admin\OrderServiceProviders\DTOs;

class OrderServiceProviderListDTO extends OrderServiceProviderDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
