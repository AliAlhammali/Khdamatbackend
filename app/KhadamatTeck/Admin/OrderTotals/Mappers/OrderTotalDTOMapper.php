<?php
namespace App\KhadamatTeck\Admin\OrderTotals\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\OrderTotals\DTOs\OrderTotalDTO;
use App\KhadamatTeck\Admin\OrderTotals\DTOs\OrderTotalListDTO;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;

class OrderTotalDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): OrderTotalDTO
    {

        return self::prepareData(new OrderTotalDTO(), $request);
    }

    public static function mapFromDB($OrderTotal): OrderTotalDTO
    {
        return self::prepareData(new OrderTotalDTO(), $OrderTotal);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): OrderTotalDTO
    {
        if ($listing) {
            $dto = new OrderTotalListDTO();
        } else {
            $dto = self::prepareData(new OrderTotalDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(OrderTotalDTO $dto, $data)
    {
                    $dto->setId($data->id);
            $dto->setOrderId($data->order_id);
            $dto->setMerchantId($data->merchant_id);
            $dto->setMerchantUserId($data->merchant_user_id);
            $dto->setItemId($data->item_id);
            $dto->setQuantity($data->quantity);
            $dto->setItemPrice($data->item_price);
            $dto->setOrderOtp($data->order_otp);
            $dto->setMerchantUserCommissionTotal($data->merchant_user_commission_total);
            $dto->setMerchantUserCommissionSupTotal($data->merchant_user_commission_sup_total);
            $dto->setMerchantUserCommissionVat($data->merchant_user_commission_vat);
            $dto->setSpTotal($data->sp_total);
            $dto->setSpSupTotal($data->sp_sup_total);
            $dto->setSpVat($data->sp_vat);
            $dto->setSupTotal($data->sup_total);
            $dto->setVat($data->vat);
            $dto->setTotal($data->total);

        return $dto;
    }
}
