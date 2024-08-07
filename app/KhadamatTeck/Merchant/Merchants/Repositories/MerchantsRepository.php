<?php

namespace App\KhadamatTeck\Merchant\Merchants\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\Merchants\Mappers\MerchantDTOMapper;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class MerchantsRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Merchant());
    }

    public function findAll(): array|Collection
    {
        return Merchant::query()->get();
    }

    public function paginateMerchants($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(Merchant::class)
            ->allowedFilters(Merchant::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findMerchant(string $id)
    {
        return Merchant::findOrFail($id);
    }

    public function createMerchant(array $data)
    {
        return MerchantDTOMapper::fromModel(Merchant::create($data));
    }

    public function updateMerchant($model, array $data)
    {
        $model->fill($data)->save();
        return MerchantDTOMapper::fromModel($model);
    }

    public function deleteMerchant($model)
    {
        $model->delete();
        return MerchantDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return Merchant::listing()->get();
    }
}
