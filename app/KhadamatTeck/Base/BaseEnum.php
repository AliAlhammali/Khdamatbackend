<?php

namespace App\KhadamatTeck\Base;

abstract class BaseEnum
{
    public static array $humanizedConstants = [];

    /**
     * Returns class constant values
     *
     * @return array
     */
    public static function toArray($valuesOnly = false): array
    {
        $class = new \ReflectionClass(static::class);
        if ($valuesOnly) {
            return array_values($class->getConstants());
        }
        return $class->getConstants();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(',', static::toArray());
    }

    abstract static function setHumanizedConstants();

    public static function humanize($constant): string
    {
        $calledEnum = get_called_class();
        $calledEnum = new $calledEnum();
        $calledEnum::setHumanizedConstants();
        return (self::$humanizedConstants[$constant]) ?: "";
    }
}
