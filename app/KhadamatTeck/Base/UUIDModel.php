<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Support\Str;

trait UUIDModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $model): void {
            $model->id = Str::uuid()->toString();
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
