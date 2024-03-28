<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Base\Traits\DBSelectUtils;
use Prettus\Repository\Eloquent\BaseRepository;

class Repository extends BaseRepository implements RepositoryInterface
{
    public function model()
    {
        return $this->getModel();
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function minimalListWithFilter(
        array $listFields = ['id', 'title'],
        array $with = [],
        array $where = []
    ): \Illuminate\Database\Eloquent\Collection|array
    {

        $query = $this->getModel()->select($listFields)->limit(request('limit', 250));
        if (!empty($with)) {
            $query = $query->with($with);
        }
        if (!empty($where)) {
            $query = $query->where($where);
        }
        if (!empty($with) && !empty($where)) {
            $query = $query->with($with)->where($where);
        }
        return QueryBuilder::for(
            $query
        )
            ->allowedFilters($this->getModel()->getAllowedFilters())
            ->allowedSorts($this->getModel()->getAllowedSorts())
            ->get();
    }
}
