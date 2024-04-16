<?php

namespace App\KhadamatTeck\Admin\MerchantBranches\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Admin\MerchantBranches\Mappers\MerchantBranchDTOMapper;
use App\KhadamatTeck\Admin\MerchantBranches\Models\MerchantBranch;
use Spatie\QueryBuilder\QueryBuilder;

class MerchantBranchesRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new MerchantBranch());
    }

    public function findAll(): array|Collection
    {
        return MerchantBranch::query()->get();
    }

    public function paginateMerchantBranches($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(MerchantBranch::class)
            ->allowedFilters(MerchantBranch::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findMerchantBranch(string $id)
    {
        return MerchantBranch::findOrFail($id);
    }

    public function createMerchantBranch(array $data)
    {
        return MerchantBranchDTOMapper::fromModel(MerchantBranch::create($data));
    }

    public function updateMerchantBranch($model, array $data)
    {
        $model->fill($data)->save();
        return MerchantBranchDTOMapper::fromModel($model);
    }

    public function deleteMerchantBranch($model)
    {
        $model->delete();
        return MerchantBranchDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return MerchantBranch::listing()->get();
    }
}
