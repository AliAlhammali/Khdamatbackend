<?php

namespace App\KhadamatTeck\Admin\Settings\Mappers;

use App\KhadamatTeck\Admin\Settings\DTO\SettingsDTO;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\DTOInterface;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;

class SettingsDTOMapper implements DTOInterface
{
    public static function mapFromRequest(KhadamatTeckRequest $request): SettingsDTO
    {
        return new SettingsDTO($request->key, $request->value);
    }

    public static function fromCollection(Collection $data): array
    {
        return $data->map(fn(array $group) => self::fromArray($group))->toArray();
    }

    public static function fromArray(array $group): array
    {
        return collect($group)->map(fn($item) => self::fromModel($item))->toArray();
    }

    public static function fromModel($setting): SettingsDTO
    {
        return new SettingsDTO($setting->key, $setting->value);
    }
}
