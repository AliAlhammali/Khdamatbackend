<?php

namespace App\KhadamatTeck\Admin\OrderTotals\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Admin\OrderTotals\Mappers\OrderTotalDTOMapper;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;
use Spatie\QueryBuilder\QueryBuilder;

class OrderTotalsRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new OrderTotal());
    }

    public function findAll(): array|Collection
    {
        return OrderTotal::query()->get();
    }

    public function paginateOrderTotals($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(OrderTotal::class)
            ->allowedFilters(OrderTotal::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findOrderTotal(string $id)
    {
        return OrderTotal::findOrFail($id);
    }

    public function createOrderTotal(array $data)
    {
        return OrderTotalDTOMapper::fromModel(OrderTotal::create($data));
    }

    public function updateOrderTotal($model, array $data)
    {
        $model->fill($data)->save();
        return OrderTotalDTOMapper::fromModel($model);
    }

    public function deleteOrderTotal($model)
    {
        $model->delete();
        return OrderTotalDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return OrderTotal::listing()->get();
    }
}
