<?php

namespace App\KhadamatTeck\Admin\MerchantBranches\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\MerchantBranches\DTOs\MerchantBranchDTO;
use App\KhadamatTeck\Admin\MerchantBranches\DTOs\MerchantBranchListDTO;
use App\KhadamatTeck\Admin\MerchantBranches\Models\MerchantBranch;

class MerchantBranchDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): MerchantBranchDTO
    {

        return self::prepareData(new MerchantBranchDTO(), $request);
    }

    public static function mapFromDB($MerchantBranch): MerchantBranchDTO
    {
        return self::prepareData(new MerchantBranchDTO(), $MerchantBranch);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): MerchantBranchDTO
    {
        if ($listing) {
            $dto = new MerchantBranchListDTO();
        } else {
            $dto = self::prepareData(new MerchantBranchDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(MerchantBranchDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setLocation($data->location->pointToArray());
        $dto->setName($data->name);
        $dto->setMerchantId($data->merchant_id);
        $dto->setAddress($data->address);
        $dto->setIsActive($data->is_active);

        return $dto;
    }
}
