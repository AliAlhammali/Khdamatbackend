<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class UnitOwnerTenantScope implements Scope
{
    const UNIT_TENANT_OWNER_COLUMN = 'customer_id';

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
        if (pmsAuth() && (pmsAuth()->getUser()->role == RulesEnums::Role_Unit_Tenant
                || pmsAuth()->getUser()->role == RulesEnums::Role_Unit_Owner)
        ) {
            if (Schema::hasColumn(
                    $model->getTable(),
                    self::UNIT_TENANT_OWNER_COLUMN
                )
                and pmsAuth()
            ) {
                $builder->where(
                    self::UNIT_TENANT_OWNER_COLUMN,
                    pmsAuth()->getUser()->id
                );
            }
        }
    }
}
