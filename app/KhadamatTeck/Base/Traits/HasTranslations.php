<?php
namespace App\KhadamatTeck\Base\Traits;

use Spatie\Translatable\HasTranslations as BaseHasTranslations;

trait HasTranslations
{
    use BaseHasTranslations;

    public function getLocale(): string
    {
        $default = config('app.locale')?:'en';
        return $this->translationLocale ?: $default;
    }
}
