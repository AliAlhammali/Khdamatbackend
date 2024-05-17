<?php

namespace App\KhadamatTeck\Admin\Dashboard\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\Dashboard\DTOs\DashboardTopCategoryServiceDTO;
use App\KhadamatTeck\Admin\Dashboard\DTOs\DashboardListDTO;
use App\KhadamatTeck\Admin\Dashboard\Models\Dashboard;

class DashboardTopCatsAndServicesDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): DashboardTopCategoryServiceDTO
    {

        return self::prepareData(new DashboardTopCategoryServiceDTO(), $request);
    }

    public static function mapFromDB($Dashboard): DashboardTopCategoryServiceDTO
    {
        return self::prepareData(new DashboardTopCategoryServiceDTO(), $Dashboard);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): DashboardTopCategoryServiceDTO
    {
        if ($listing) {
            $dto = new DashboardListDTO();
        } else {
            $dto = self::prepareData(new DashboardTopCategoryServiceDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(DashboardTopCategoryServiceDTO $dto, $data)
    {
        $dto->setName((array)json_decode($data->name));
        $dto->setOrderCount($data->order_count);
        $dto->setCategoryId($data->category_id ?? null);
        $dto->setServiceId($data->services_id ?? null);
        return $dto;
    }
}
