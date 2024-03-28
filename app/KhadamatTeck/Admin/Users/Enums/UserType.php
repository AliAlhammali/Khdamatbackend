<?php

namespace App\KhadamatTeck\Admin\Users\Enums;

use BenSampo\Enum\Enum;

class UserType extends Enum
{
    const admin = 'admin';
    const account_manager = 'account_manager';
    const senior_officer = 'senior_officer';
    const officer = 'officer';
    const finance = 'finance';
}
