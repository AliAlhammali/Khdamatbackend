<?php

namespace App\KhadamatTeck\Admin\OrderAddress\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Admin\OrderAddress\Mappers\OrderAddressDTOMapper;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use Spatie\QueryBuilder\QueryBuilder;

class OrderAddressRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new OrderAddress());
    }

    public function findAll(): array|Collection
    {
        return OrderAddress::query()->get();
    }

    public function paginateOrderAddress($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(OrderAddress::class)
            ->allowedFilters(OrderAddress::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findOrderAddress(string $id)
    {
        return OrderAddress::findOrFail($id);
    }

    public function createOrderAddress(array $data)
    {
        return OrderAddressDTOMapper::fromModel(OrderAddress::create($data));
    }

    public function updateOrderAddress($model, array $data)
    {
        $model->fill($data)->save();
        return OrderAddressDTOMapper::fromModel($model);
    }

    public function deleteOrderAddress($model)
    {
        $model->delete();
        return OrderAddressDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return OrderAddress::listing()->get();
    }
}
