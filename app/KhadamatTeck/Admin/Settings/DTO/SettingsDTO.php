<?php

namespace App\KhadamatTeck\Admin\Settings\DTO;

final class SettingsDTO implements \JsonSerializable
{
    public function __construct(
        private string $key,
        private Mixed $value,
    ) {
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return bool
     */
    public function isValue(): bool
    {
        return $this->value;
    }

    /**
     * @param Mixed $value
     */
    public function setValue(Mixed $value): void
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        return [
            'key'   =>  $this->key,
            'value'   =>  $this->value,
        ];
    }
}
