<?php

namespace App\KhadamatTeck\Admin\OrderItems\Repositories;

use App\KhadamatTeck\Admin\OrderItems\Mappers\OrderItemDTOMapper;
use App\KhadamatTeck\Admin\OrderItems\Models\OrderItem;
use App\KhadamatTeck\Base\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class OrderItemsRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new OrderItem());
    }

    public function findAll(): array|Collection
    {
        return OrderItem::query()->get();
    }

    public function paginateOrderItems($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(OrderItem::class)
            ->allowedFilters(OrderItem::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findOrderItem(string $id)
    {
        return OrderItem::findOrFail($id);
    }

    public function createOrderItem(array $data)
    {
        return OrderItemDTOMapper::fromModel(OrderItem::create($data));
    }

    public function updateOrderItem($model, array $data)
    {
        $model->fill($data)->save();
        return OrderItemDTOMapper::fromModel($model);
    }

    public function deleteOrderItem($model)
    {
        $model->delete();
        return OrderItemDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return OrderItem::listing()->get();
    }
}
