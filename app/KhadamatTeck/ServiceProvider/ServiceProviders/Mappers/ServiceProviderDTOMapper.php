<?php
namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use Illuminate\Support\Collection;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\DTOs\ServiceProviderDTO;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\DTOs\ServiceProviderListDTO;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;

class ServiceProviderDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): ServiceProviderDTO
    {

        return self::prepareData(new ServiceProviderDTO(), $request);
    }

    public static function mapFromDB($ServiceProvider): ServiceProviderDTO
    {
        return self::prepareData(new ServiceProviderDTO(), $ServiceProvider);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): ServiceProviderDTO
    {
        if ($listing) {
            $dto = new ServiceProviderListDTO();
        } else {
            $dto = self::prepareData(new ServiceProviderDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }
    private static function prepareData(ServiceProviderDTO $dto, $data)
    {
                    $dto->setId($data->id);
            $dto->setTitle($data->title);
            $dto->setDescription($data->description);
            $dto->setStatus($data->status);
            $dto->setAddress($data->address);
            $dto->setPhone($data->phone);
            $dto->setLogo($data->logo);
            $dto->setVatFile($data->vat_file);
            $dto->setCrFile($data->cr_file);
            $dto->setSalesAgreementFile($data->sales_agreement_file);
            $dto->setCrNumber($data->cr_number);
            $dto->setVatNumber($data->vat_number);
        $dto->setEmail($data->email);

        return $dto;
    }
}
