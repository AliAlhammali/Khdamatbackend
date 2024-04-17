<?php

namespace App\KhadamatTeck\Admin\Users\Enums;

use BenSampo\Enum\Enum;

class UserOtpNotifyTypes extends Enum
{
    const ALL = 'all';
    const SMS = 'sms';
    const EMAIL = 'email';
}
