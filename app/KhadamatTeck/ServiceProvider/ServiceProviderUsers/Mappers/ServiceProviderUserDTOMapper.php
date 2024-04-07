<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\DTOs\ServiceProviderUserDTO;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\DTOs\ServiceProviderUserListDTO;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;

class ServiceProviderUserDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): ServiceProviderUserDTO
    {

        return self::prepareData(new ServiceProviderUserDTO(), $request);
    }

    public static function mapFromDB($ServiceProviderUser): ServiceProviderUserDTO
    {
        return self::prepareData(new ServiceProviderUserDTO(), $ServiceProviderUser);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): ServiceProviderUserDTO
    {
        if ($listing) {
            $dto = new ServiceProviderUserListDTO();
        } else {
            $dto = self::prepareData(new ServiceProviderUserDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(ServiceProviderUserDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setName($data->name);
        $dto->setServiceProviderId($data->service_provider_id);
        $dto->setEmail($data->email);
        $dto->setAddress($data->address);
        $dto->setPhone($data->phone);
        $dto->setRole($data->role);
        $dto->setPassword($data->password);
        $dto->setStatus($data->status);
        $dto->setServiceProvider($data->serviceProvider);
        return $dto;
    }
}
