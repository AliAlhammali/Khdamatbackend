<?php

namespace App\KhadamatTeck\Admin\Categories\Mappers;

use App\KhadamatTeck\Admin\Categories\DTOs\CategoryDTO;
use App\KhadamatTeck\Admin\Categories\DTOs\CategoryListDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Support\Collection;

class CategoryDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): CategoryDTO
    {

        return self::prepareData(new CategoryDTO(), $request);
    }

    public static function mapFromDB($Category): CategoryDTO
    {
        return self::prepareData(new CategoryDTO(), $Category);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): CategoryDTO
    {
        if ($listing) {
            $dto = new CategoryListDTO();
        } else {
            $dto = self::prepareData(new CategoryDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(CategoryDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setTitle($data->getTranslations('title'));
        $dto->setSlug($data->getTranslations('slug'));
        $dto->setStatus($data->status);
        $dto->setMerchantId($data->merchant_id);
        if (request('includeCategoryMerchant', true))
            $dto->setMerchant($data->merchant);
        if (request('includeCategoryParent', true))
            $dto->setParent($data->parent);
        if (request('includeCategoryChildren', true))
            $dto->setChildren($data->children);


        return $dto;
    }
}
