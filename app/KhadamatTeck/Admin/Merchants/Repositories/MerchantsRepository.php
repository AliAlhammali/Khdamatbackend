<?php

namespace App\KhadamatTeck\Admin\Merchants\Repositories;

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
        /* @var Merchant $merchant */
        $merchant = Merchant::create($data);
        if ($data['owner']) {
            $data['owner']['password'] = bcrypt(123456);
            $merchant->users()->create($data['owner']);
        }

        return MerchantDTOMapper::fromModel($merchant);
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
