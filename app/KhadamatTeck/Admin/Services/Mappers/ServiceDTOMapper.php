<?php

namespace App\KhadamatTeck\Admin\Services\Mappers;

use App\KhadamatTeck\Admin\Services\DTOs\ServiceDTO;
use App\KhadamatTeck\Admin\Services\DTOs\ServiceListDTO;
use App\KhadamatTeck\Admin\Services\DTOs\ServiceToCreateOrderDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Support\Collection;

class ServiceDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): ServiceDTO
    {

        return self::prepareData(new ServiceDTO(), $request);
    }

    public static function mapFromDB($Service): ServiceDTO
    {
        return self::prepareData(new ServiceDTO(), $Service);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): ServiceDTO
    {
        if (request('forCreatingOrder', false)) {
            $dto = self::fromModelToCreateOrder($data);
        } else {
            if ($listing) {
                $dto = new ServiceListDTO();
            } else {
                $dto = self::prepareData(new ServiceDTO(), $data);
            }
        }

        return $dto;
    }

    public static function fromModelToCreateOrder($data): ServiceDTO
    {
        $dto = new ServiceToCreateOrderDTO();
        $dto->setId($data->id);
        $dto->setTitle($data->getTranslations('title'));
        $dto->setSlug($data->getTranslations('slug'));
        $dto->setDescription($data->description);
        $dto->setPrice($data->price);


        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(ServiceDTO $dto, $data)
    {

        $dto->setId($data->id);
        $dto->setTitle($data->getTranslations('title'));
        $dto->setSlug($data->getTranslations('slug'));
        $dto->setDescription($data->description);
        $dto->setStatus($data->status);
        $dto->setMerchantId($data->merchant_id);
        $dto->setCategoryId($data->category_id);
        $dto->setMainCategoryId($data->main_category_id);
        $dto->setPrice($data->price);
        if (request('includeServiceMerchant', true))
            $dto->setMerchant($data->merchant);
        if (request('includeServiceCategory', true))
            $dto->setCategory($data->category);
        if (request('includeServiceMainCategory', true))
            $dto->setMainCategory($data->mainCategory);
        $dto->setCostPrice($data->cost_price);
        $dto->setSpPrice($data->sp_price);

        return $dto;
    }
}
