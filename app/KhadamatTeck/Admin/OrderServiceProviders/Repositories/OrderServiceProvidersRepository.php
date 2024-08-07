<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\Repositories;

use App\KhadamatTeck\Admin\OrderServiceProviders\Mappers\OrderServiceProviderDTOMapper;
use App\KhadamatTeck\Admin\OrderServiceProviders\Models\OrderServiceProvider;
use App\KhadamatTeck\Base\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class OrderServiceProvidersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new OrderServiceProvider());
    }

    public function findAll(): array|Collection
    {
        return OrderServiceProvider::query()->get();
    }

    public function paginateOrderServiceProviders($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(OrderServiceProvider::class)
            ->allowedFilters(OrderServiceProvider::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findOrderServiceProvider(string $id)
    {
        return OrderServiceProvider::findOrFail($id);
    }

    public function createOrderServiceProvider(array $data)
    {
        return OrderServiceProviderDTOMapper::fromModel(OrderServiceProvider::create($data));
    }

    public function updateOrderServiceProvider($model, array $data)
    {
        $model->fill($data)->save();
        return OrderServiceProviderDTOMapper::fromModel($model);
    }

    public function deleteOrderServiceProvider($model)
    {
        $model->delete();
        return OrderServiceProviderDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return OrderServiceProvider::listing()->get();
    }
}
