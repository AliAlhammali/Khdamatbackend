<?php
namespace App\KhadamatTeck\Admin\OrderServiceProviders\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\DTOs\OrderServiceProviderDTO;
use App\KhadamatTeck\Admin\OrderServiceProviders\DTOs\OrderServiceProviderListDTO;
use App\KhadamatTeck\Admin\OrderServiceProviders\Models\OrderServiceProvider;

class OrderServiceProviderDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): OrderServiceProviderDTO
    {

        return self::prepareData(new OrderServiceProviderDTO(), $request);
    }

    public static function mapFromDB($OrderServiceProvider): OrderServiceProviderDTO
    {
        return self::prepareData(new OrderServiceProviderDTO(), $OrderServiceProvider);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): OrderServiceProviderDTO
    {
        if ($listing) {
            $dto = new OrderServiceProviderListDTO();
        } else {
            $dto = self::prepareData(new OrderServiceProviderDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(OrderServiceProviderDTO $dto, $data)
    {
                    $dto->setId($data->id);
            $dto->setOrderId($data->order_id);
            $dto->setServiceProviderId($data->service_provider_id);
            $dto->setActive($data->active);

        return $dto;
    }
}
