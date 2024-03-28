<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class CompanyScope implements Scope
{
    const COLUMN = 'company_id';

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        if (Schema::hasColumn($model->getTable(), self::COLUMN) and pmsAuth() and $companyId = pmsAuth()->getPmsCompanyId()) {
            $builder->where(self::COLUMN, $companyId);
        }
    }
}
