<?php
namespace App\KhadamatTeck\Admin\OrderAddress\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\OrderAddress\DTOs\OrderAddressDTO;
use App\KhadamatTeck\Admin\OrderAddress\DTOs\OrderAddressListDTO;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;

class OrderAddressDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): OrderAddressDTO
    {

        return self::prepareData(new OrderAddressDTO(), $request);
    }

    public static function mapFromDB($OrderAddress): OrderAddressDTO
    {
        return self::prepareData(new OrderAddressDTO(), $OrderAddress);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): OrderAddressDTO
    {
        if ($listing) {
            $dto = new OrderAddressListDTO();
        } else {
            $dto = self::prepareData(new OrderAddressDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(OrderAddressDTO $dto, $data)
    {
                    $dto->setId($data->id);
            $dto->setOrderId($data->order_id);
            $dto->setName($data->name);
            $dto->setEmail($data->email);
            $dto->setPhone($data->phone);
            $dto->setAddress($data->address);
            $dto->setVat($data->vat);
            $dto->setLocation($data->location);
            $dto->setPickUpLocation($data->pick_up_location);
            $dto->setIsDefaultAddress($data->is_default_address);

        return $dto;
    }
}
