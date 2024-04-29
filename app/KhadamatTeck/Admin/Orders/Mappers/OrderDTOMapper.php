<?php

namespace App\KhadamatTeck\Admin\Orders\Mappers;

use App\KhadamatTeck\Admin\Categories\Mappers\CategoryDTOMapper;
use App\KhadamatTeck\Admin\MerchantClients\Mappers\MerchantClientDTOMapper;
use App\KhadamatTeck\Admin\Orders\DTOs\OrderDTO;
use App\KhadamatTeck\Admin\Orders\DTOs\OrderListDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Mappers\MerchantUserDTOMapper;
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
        $dto->setStatus($data->status);
        $dto->setOrderOtp($data->order_otp);
        $dto->setCreatedAt($data->created_at);
        $dto->setPickUpType($data->pick_up_type);
        $dto->setMerchantBranchId($data->merchant_branch_id);

        $dto->setStartedAt($data->started_at);
        $dto->setCompletedAt($data->completed_at);

        $dto->setAddress($data->address);
        $dto->setTotals($data->total);
        $dto->setItems($data->items);

        if (request('includeOrderMerchantUser', false))
            $dto->setMerchantUser(MerchantUserDTOMapper::fromModel($data->merchantUser));
        if (request('includeOrderMerchantClient', false))
            $dto->setMerchantClient(MerchantClientDTOMapper::fromModel($data->merchantClient));
        if (request('includeOrderMainCategory', false))
            $dto->setMerchantClient(CategoryDTOMapper::fromModel($data->mainCategory));
        return $dto;
    }
}
