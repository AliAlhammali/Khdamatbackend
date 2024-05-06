<?php

namespace App\KhadamatTeck\Base\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OwnSPData implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {

        if (SPAuth()->user()) {
            $role = SPAuth()->user()->role;

            if ($role == 'Admin')
                $builder->where('service_provider_id', SPAuth()->user()->service_provider_id);
            else
                $builder->where('service_provider_id', SPAuth()->user()->service_provider_id)->where('service_provider_user_id', SPAuth()->user()->id);
        }
    }
}
