<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Mappers\ServiceProviderUserDTOMapper;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceProviderUsersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new ServiceProviderUser());
    }

    public function findAll(): array|Collection
    {
        return ServiceProviderUser::query()->get();
    }

    public function paginateServiceProviderUsers($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        $spID = SPAuth()->user()->service_provider_id;
        return QueryBuilder::for(ServiceProviderUser::where(['service_provider_id'=>$spID]))
            ->allowedFilters(ServiceProviderUser::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findServiceProviderUser(string $id)
    {
        return ServiceProviderUser::findOrFail($id);
    }

    public function createServiceProviderUser(array $data)
    {
        if (!isset($data['service_provider_id']))
            $data['service_provider_id'] = SPAuth()->user()->serviceProvider->id;
        return ServiceProviderUserDTOMapper::fromModel(ServiceProviderUser::create($data));
    }

    public function updateServiceProviderUser($model, array $data)
    {
        $model->fill($data)->save();
        return ServiceProviderUserDTOMapper::fromModel($model);
    }

    public function deleteServiceProviderUser($model)
    {
        $model->delete();
        return ServiceProviderUserDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return ServiceProviderUser::listing()->get();
    }
}
