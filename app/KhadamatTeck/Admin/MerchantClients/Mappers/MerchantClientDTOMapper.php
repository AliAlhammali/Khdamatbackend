<?php

namespace App\KhadamatTeck\Admin\MerchantClients\Mappers;

use App\KhadamatTeck\Admin\MerchantClients\DTOs\MerchantClientDTO;
use App\KhadamatTeck\Admin\MerchantClients\DTOs\MerchantClientListDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Support\Collection;

class MerchantClientDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): MerchantClientDTO
    {

        return self::prepareData(new MerchantClientDTO(), $request);
    }

    public static function mapFromDB($MerchantClient): MerchantClientDTO
    {
        return self::prepareData(new MerchantClientDTO(), $MerchantClient);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): MerchantClientDTO
    {
        if ($listing) {
            $dto = new MerchantClientListDTO();
        } else {
            $dto = self::prepareData(new MerchantClientDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(MerchantClientDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setLocation($data->location->pointToArray());
        $dto->setName($data->name);
        $dto->setMerchantId($data->merchant_id);
        $dto->setEmail($data->email);
        $dto->setAddress($data->address);
        $dto->setPhone($data->phone);
        $dto->setIsActive($data->is_active);

        return $dto;
    }
}
