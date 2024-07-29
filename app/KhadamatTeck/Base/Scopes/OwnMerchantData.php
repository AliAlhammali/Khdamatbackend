<?php

namespace App\KhadamatTeck\Base\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OwnMerchantData implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (MerchantAuth()->check()) {
            $role = MerchantAuth()->user()->role;
//            $builder->where($model->getTable() . '.merchant_id', MerchantAuth()->user()->merchant_id);
            if($role == 'Admin')
                $builder->where('merchant_id', MerchantAuth()->user()->merchant_id);
            else
                $builder->where('merchant_id', MerchantAuth()->user()->merchant_id)->where('merchant_user_id',MerchantAuth()->user()->id);
        }
    }
}
