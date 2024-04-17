<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Units\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class PropertyOwnerScope implements Scope
{
    const PROPERTY_MANAGER_COLUMN = 'property_manager_id';
    const AREA_MANAGER_COLUMN = 'area_manager_id';

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
        if (pmsAuth()) {
            $userId = pmsAuth()->getUser()->id;
            $userRole = pmsAuth()->getUser()->role;
            //$userType =  auth()->user()->user_type;

            if ($userRole == RulesEnums::Role_Area_Manager) {
                if (Schema::hasColumn($model->getTable(), self::AREA_MANAGER_COLUMN)) {
                    $builder->where(self::AREA_MANAGER_COLUMN, $userId);
                }

            } elseif ($userRole == RulesEnums::Role_Property_Manager) {
                if (Schema::hasColumn($model->getTable(), self::PROPERTY_MANAGER_COLUMN)) {
                    $builder->where(self::PROPERTY_MANAGER_COLUMN, $userId);
                }

            } else if (in_array($userRole, [RulesEnums::Role_Unit_Owner, RulesEnums::Role_Unit_Tenant])) {
                $propertyIds = Unit::where("customer_id", $userId)->get()->pluck("property_id");
                $builder->whereIn("id", $propertyIds);

            } elseif (!in_array($userRole, [RulesEnums::Role_Accountant, RulesEnums::Role_Admin])) {
                $builder->where(['user_id' => $userId])
                    ->orWhere('team_member_id', $userId)
                    ->orWhere(['team_leader_id' => $userId]);
            }
        }
    }
}
