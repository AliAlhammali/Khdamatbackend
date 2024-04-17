<?php

namespace App\KhadamatTeck\ServiceProvider\Orders\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\ServiceProvider\Orders\DTOs\OrderDTO;
use App\KhadamatTeck\ServiceProvider\Orders\DTOs\OrderListDTO;
use App\KhadamatTeck\ServiceProvider\Orders\Models\Order;
use Illuminate\Support\Collection;

class OrderDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): OrderDTO
    {

        return self::prepareData(new OrderDTO(), $request);
    }

    public static function mapFromDB($Order): OrderDTO
    {
        return self::prepareData(new OrderDTO(), $Order);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): OrderDTO
    {
        if ($listing) {
            $dto = new OrderListDTO();
        } else {
            $dto = self::prepareData(new OrderDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(OrderDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setMerchantId($data->merchant_id);
        $dto->setMerchantUserId($data->merchant_user_id);
        $dto->setMerchantClientId($data->merchant_client_id);
        $dto->setMainCategoryId($data->main_category_id);
        $dto->setCategoryId($data->category_id);
        $dto->setStatus($data->status);
        $dto->setOrderOtp($data->order_otp);
        $dto->setCreatedAt($data->created_at);
        $dto->setPickUpType($data->pick_up_type);
        $dto->setMerchantBranchId($data->merchant_branch_id);

        return $dto;
    }
}
