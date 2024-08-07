<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Properties\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class PropertyScope implements Scope
{
    const COLUMN = 'property_id';

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Schema::hasColumn($model->getTable(), self::COLUMN) and auth()->check()) {
            $propertyIds = Property::where("company_id", auth()->user()->company_id)->pluck("id");
            $builder->whereIn(self::COLUMN, $propertyIds);
        }
    }
}
