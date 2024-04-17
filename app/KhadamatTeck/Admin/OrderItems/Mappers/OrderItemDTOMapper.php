<?php

namespace App\KhadamatTeck\Admin\OrderItems\Mappers;

use App\KhadamatTeck\Admin\OrderItems\DTOs\OrderItemDTO;
use App\KhadamatTeck\Admin\OrderItems\DTOs\OrderItemListDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Support\Collection;

class OrderItemDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): OrderItemDTO
    {

        return self::prepareData(new OrderItemDTO(), $request);
    }

    public static function mapFromDB($OrderItem): OrderItemDTO
    {
        return self::prepareData(new OrderItemDTO(), $OrderItem);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): OrderItemDTO
    {
        if ($listing) {
            $dto = new OrderItemListDTO();
        } else {
            $dto = self::prepareData(new OrderItemDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(OrderItemDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setOrderId($data->order_id);
        $dto->setItemId($data->item_id);
        $dto->setQuantity($data->quantity);
        $dto->setItemPrice($data->item_price);
        $dto->setSupTotal($data->sup_total);
        $dto->setVat($data->vat);
        $dto->setTotal($data->total);
        $dto->setOrderOtp($data->order_otp);

        return $dto;
    }
}
