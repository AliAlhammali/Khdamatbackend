<?php
namespace App\KhadamatTeck\Merchant\MerchantUsers\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\DTOs\MerchantUserDTO;
use App\KhadamatTeck\Merchant\MerchantUsers\DTOs\MerchantUserListDTO;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;

class MerchantUserDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): MerchantUserDTO
    {

        return self::prepareData(new MerchantUserDTO(), $request);
    }

    public static function mapFromDB($MerchantUser): MerchantUserDTO
    {
        return self::prepareData(new MerchantUserDTO(), $MerchantUser);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): MerchantUserDTO
    {
        if ($listing) {
            $dto = new MerchantUserListDTO();
        } else {
            $dto = self::prepareData(new MerchantUserDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(MerchantUserDTO $dto, $data)
    {
                    $dto->setId($data->id);
            $dto->setName($data->name);
            $dto->setMerchantId($data->merchant_id);
            $dto->setEmail($data->email);
            $dto->setAddress($data->address);
            $dto->setPhone($data->phone);
            $dto->setRole($data->role);
            $dto->setPassword($data->password);
            $dto->setStatus($data->status);

        return $dto;
    }
}
