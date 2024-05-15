<?php

namespace App\KhadamatTeck\Merchant\Dashboard\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\Dashboard\Mappers\DashboardDTOMapper;
use App\KhadamatTeck\Merchant\Dashboard\Models\Dashboard;
use Spatie\QueryBuilder\QueryBuilder;

class DashboardRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Dashboard());
    }

    public function findAll(): array|Collection
    {
        return Dashboard::query()->get();
    }

    public function paginateDashboard($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(Dashboard::class)
            ->allowedFilters(Dashboard::getAllowedFilters())
            ->allowedSorts(Dashboard::getAllowedSorts())
            ->defaultSort(Dashboard::getDefaultSort())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findDashboard(string $id)
    {
        return Dashboard::findOrFail($id);
    }

    public function createDashboard(array $data)
    {
        return DashboardDTOMapper::fromModel(Dashboard::create($data));
    }

    public function updateDashboard($model, array $data)
    {
        $model->fill($data)->save();
        return DashboardDTOMapper::fromModel($model);
    }

    public function deleteDashboard($model)
    {
        $model->delete();
        return DashboardDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return Dashboard::listing()->get();
    }
}
