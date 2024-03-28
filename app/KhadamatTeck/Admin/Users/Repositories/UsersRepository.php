<?php

namespace App\KhadamatTeck\Admin\Users\Repositories;

use App\KhadamatTeck\Admin\Users\Mappers\UserDTOMapper;
use App\KhadamatTeck\Admin\Users\Models\User;
use App\KhadamatTeck\Base\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class UsersRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new User());
    }

    public function findAll(): array|Collection
    {
        return User::query()->get();
    }

    public function paginateUsers($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(User::class)
            ->allowedFilters(User::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findUser(string $id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data)
    {
        return UserDTOMapper::fromModel(User::create($data));
    }

    public function updateUser($model, array $data)
    {
        $model->fill($data)->save();
        return UserDTOMapper::fromModel($model);
    }

    public function deleteUser($model)
    {
        $model->delete();
        return UserDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return User::listing()->get();
    }
}
