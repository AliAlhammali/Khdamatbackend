<?php

namespace App\KhadamatTeck\Client\MerchantClients\Repositories;

use App\KhadamatTeck\Admin\MerchantClients\Mappers\MerchantClientDTOMapper;
use App\KhadamatTeck\Client\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Base\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class MerchantClientsRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new MerchantClient());
    }

    public function findAll(): array|Collection
    {
        return MerchantClient::query()->get();
    }

    public function paginateMerchantClients($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(MerchantClient::class)
            ->allowedFilters(MerchantClient::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findMerchantClient(string $id)
    {
        return MerchantClient::findOrFail($id);
    }

    public function createMerchantClient(array $data)
    {
        $data['password'] = bcrypt($data['password'] ?? 123456);
        return MerchantClientDTOMapper::fromModel(MerchantClient::create($data));
    }

    public function updateMerchantClient($model, array $data)
    {
        $model->fill($data)->save();
        return MerchantClientDTOMapper::fromModel($model);
    }

    public function deleteMerchantClient($model)
    {
        $model->delete();
        return MerchantClientDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return MerchantClient::listing()->get();
    }
}
