<?php

namespace App\KhadamatTeck\Base\Enums;


use App\KhadamatTeck\Base\BaseEnum;

class RulesEnums extends BaseEnum
{
    const Role_Admin = 'Admin';
    const Role_Area_Manager = 'Area Manager';
    const Role_Accountant = 'Accountant';
    const Role_Property_Manager = 'Property Manager';
    const Role_Unit_Tenant = 'Unit Tenant';
    const Role_Unit_Owner = 'Unit Owner';

    static function setHumanizedConstants()
    {
        // TODO: Implement setHumanizedConstants() method.
    }
}
