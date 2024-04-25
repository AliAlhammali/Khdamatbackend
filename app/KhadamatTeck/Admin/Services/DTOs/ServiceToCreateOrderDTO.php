<?php

namespace App\KhadamatTeck\Admin\Services\DTOs;

class ServiceToCreateOrderDTO extends ServiceDTO
{
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
        ];
    }
}
