<?php

namespace App\KhadamatTeck\Base;

class BaseObserver
{
    public function prepareDescription($replacements, $description): array|string
    {
        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $description
        );
    }
}
