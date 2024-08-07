<?php
namespace App\KhadamatTeck\Merchant\Dashboard\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Merchant\Dashboard\DTOs\DashboardDTO;
use App\KhadamatTeck\Merchant\Dashboard\DTOs\DashboardListDTO;
use App\KhadamatTeck\Merchant\Dashboard\Models\Dashboard;

class DashboardDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): DashboardDTO
    {

        return self::prepareData(new DashboardDTO(), $request);
    }

    public static function mapFromDB($Dashboard): DashboardDTO
    {
        return self::prepareData(new DashboardDTO(), $Dashboard);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): DashboardDTO
    {
        if ($listing) {
            $dto = new DashboardListDTO();
        } else {
            $dto = self::prepareData(new DashboardDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(DashboardDTO $dto, $data)
    {
        
        return $dto;
    }
}
