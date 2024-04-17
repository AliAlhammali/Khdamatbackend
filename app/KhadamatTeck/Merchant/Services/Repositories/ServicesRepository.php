<?php

namespace App\KhadamatTeck\Merchant\Services\Repositories;

use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\Services\Mappers\ServiceDTOMapper;
use App\KhadamatTeck\Merchant\Services\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
        return QueryBuilder::for(ServiceModel::MerchantCategories(MerchantAuth()->id()))
            ->allowedFilters(ServiceModel::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findService(string $id)
    {
        return ServiceModel::MerchantCategories(MerchantAuth()->id())->findOrFail($id);
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
        return ServiceModel::MerchantCategories(MerchantAuth()->id())->listing()->get();
    }
}
