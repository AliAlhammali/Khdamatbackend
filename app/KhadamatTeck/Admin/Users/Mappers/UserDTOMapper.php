<?php

namespace App\KhadamatTeck\Admin\Users\Mappers;

use App\KhadamatTeck\Admin\Users\DTOs\UserDTO;
use App\KhadamatTeck\Admin\Users\DTOs\UserListDTO;
use App\KhadamatTeck\Base\BaseDTOMapper;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Support\Collection;

class UserDTOMapper extends BaseDTOMapper
{
    public static function mapFromRequest(KhadamatTeckRequest $request): UserDTO
    {

        return self::prepareData(new UserDTO(), $request);
    }

    public static function mapFromDB($User): UserDTO
    {
        return self::prepareData(new UserDTO(), $User);
    }

    public static function fromArray(array $data): array
    {
        return self::fromCollection(collect($data));
    }

    public static function fromModel($data, $listing = false): UserDTO
    {
        if ($listing) {
            $dto = new UserListDTO();
        } else {
            $dto = self::prepareData(new UserDTO(), $data);
        }
        return $dto;
    }

    public static function fromCollection(Collection $data, $listing = false): array
    {
        return $data->map(fn($item) => self::fromModel($item, $listing))->toArray();
    }

    private static function prepareData(UserDTO $dto, $data)
    {
        $dto->setId($data->id);
        $dto->setName($data->name);
        $dto->setEmail($data->email);
        $dto->setPassword($data->password);
        $dto->setEmailVerifiedAt($data->email_verified_at);
        $dto->setStatus($data->status);
        $dto->setAddress($data->address);
        $dto->setPhone($data->phone);
        $dto->setLogo($data->logo);

        return $dto;
    }
}
