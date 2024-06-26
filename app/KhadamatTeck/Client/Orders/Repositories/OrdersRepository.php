<?php

namespace App\KhadamatTeck\Client\Orders\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Admin\Orders\Mappers\OrderDTOMapper;
use App\KhadamatTeck\Client\Orders\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class OrdersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Order());
    }

    public function findAll(): array|Collection
    {
        return Order::query()->get();
    }

    public function paginateOrders($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(Order::query())
            ->allowedFilters(Order::getAllowedFilters())
            ->allowedSorts(Order::getAllowedSorts())
            ->defaultSort(Order::getDefaultSort())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findOrder(string $id)
    {
        return Order::findOrFail($id);
    }

    public function createOrder(array $data)
    {
        return OrderDTOMapper::fromModel(Order::create($data));
    }

    public function updateOrder($model, array $data)
    {
        $model->fill($data)->save();
        return OrderDTOMapper::fromModel($model);
    }

    public function deleteOrder($model)
    {
        $model->delete();
        return OrderDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return Order::listing()->get();
    }
}
