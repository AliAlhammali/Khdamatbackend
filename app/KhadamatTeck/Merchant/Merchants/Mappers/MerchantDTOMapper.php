<?php

namespace App\KhadamatTeck\Merchant\Merchants\Mappers;

use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\Merchant\Merchants\DTOs\MerchantDTO;
use App\KhadamatTeck\Merchant\Merchants\DTOs\MerchantListDTO;
use Illuminate\Support\Collection;

class MerchantDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): MerchantDTO
    {

        return self::prepareData(new MerchantDTO(), $request);
    }

    public static function mapFromDB($Merchant): MerchantDTO
    {
        return self::prepareData(new MerchantDTO(), $Merchant);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): MerchantDTO
    {
        if ($listing) {
            $dto = new MerchantListDTO();
        } else {
            $dto = self::prepareData(new MerchantDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(MerchantDTO $dto, $data)
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
        $dto->setCode($data->code);
        return $dto;
    }
}
