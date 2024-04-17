<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\DTOs;

class ServiceProviderUserListDTO extends ServiceProviderUserDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
