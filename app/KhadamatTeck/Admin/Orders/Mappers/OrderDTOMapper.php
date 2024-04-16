<?php
namespace App\KhadamatTeck\Admin\Orders\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\Orders\DTOs\OrderDTO;
use App\KhadamatTeck\Admin\Orders\DTOs\OrderListDTO;
use App\KhadamatTeck\Admin\Orders\Models\Order;

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
        
        return $dto;
    }
}
