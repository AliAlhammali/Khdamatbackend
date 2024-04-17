<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class CreatedOrderScope implements Scope
{
    const COLUMN = 'created_at';

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Schema::hasColumn($model->getTable(), self::COLUMN)) {
            $builder->orderBy($model->getTable() . '.' . self::COLUMN, 'desc');
        }
    }
}
