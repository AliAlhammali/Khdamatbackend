<?php

namespace App\KhadamatTeck\Admin\MerchantUsers\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\MerchantUsers\Mappers\MerchantUserDTOMapper;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class MerchantUsersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new MerchantUser());
    }

    public function findAll(): array|Collection
    {
        return MerchantUser::query()->get();
    }

    public function paginateMerchantUsers($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(MerchantUser::class)
            ->allowedFilters(MerchantUser::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findMerchantUser(string $id)
    {
        return MerchantUser::findOrFail($id);
    }

    public function createMerchantUser(array $data)
    {
        return MerchantUserDTOMapper::fromModel(MerchantUser::create($data));
    }

    public function updateMerchantUser($model, array $data)
    {
        $model->fill($data)->save();
        return MerchantUserDTOMapper::fromModel($model);
    }

    public function deleteMerchantUser($model)
    {
        $model->delete();
        return MerchantUserDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return MerchantUser::listing()->get();
    }
}
