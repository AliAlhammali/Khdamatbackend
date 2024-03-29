<?php

namespace App\KhadamatTeck\Merchant\Services\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\Services\Mappers\ServiceDTOMapper;
use App\KhadamatTeck\Merchant\Services\Models\Service;
use Spatie\QueryBuilder\QueryBuilder;

class ServicesRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Service());
    }

    public function findAll(): array|Collection
    {
        return ServiceModel::query()->get();
    }

    public function paginateServices($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(ServiceModel::class)
            ->allowedFilters(ServiceModel::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findService(string $id)
    {
        return ServiceModel::findOrFail($id);
    }

    public function createService(array $data)
    {
        return ServiceDTOMapper::fromModel(ServiceModel::create($data));
    }

    public function updateService($model, array $data)
    {
        $model->fill($data)->save();
        return ServiceDTOMapper::fromModel($model);
    }

    public function deleteService($model)
    {
        $model->delete();
        return ServiceDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return ServiceModel::listing()->get();
    }
}
