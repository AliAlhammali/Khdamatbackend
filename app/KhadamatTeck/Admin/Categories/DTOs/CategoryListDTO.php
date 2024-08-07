<?php

namespace App\KhadamatTeck\Admin\Categories\DTOs;

class CategoryListDTO extends CategoryDTO
{
    public function jsonSerialize(): array
    {
        return []; // TODO ADD List Fields
    }
}
