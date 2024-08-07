<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Mappers\ServiceProviderDTOMapper;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceProvidersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new ServiceProvider());
    }

    public function findAll(): array|Collection
    {
        return ServiceProvider::query()->get();
    }

    public function paginateServiceProviders($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(ServiceProvider::class)
            ->allowedFilters(ServiceProvider::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findServiceProvider(string $id)
    {
        return ServiceProvider::findOrFail($id);
    }

    public function createServiceProvider(array $data)
    {
        return ServiceProviderDTOMapper::fromModel(ServiceProvider::create($data));
    }

    public function updateServiceProvider($model, array $data)
    {
        $model->fill($data)->save();
        return ServiceProviderDTOMapper::fromModel($model);
    }

    public function deleteServiceProvider($model)
    {
        $model->delete();
        return ServiceProviderDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return ServiceProvider::listing()->get();
    }
}
