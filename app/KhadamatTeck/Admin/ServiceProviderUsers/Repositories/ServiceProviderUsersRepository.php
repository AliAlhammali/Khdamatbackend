<?php

namespace App\KhadamatTeck\Admin\ServiceProviderUsers\Repositories;

use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Mappers\ServiceProviderUserDTOMapper;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
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
        return QueryBuilder::for(ServiceProviderUser::class)
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
