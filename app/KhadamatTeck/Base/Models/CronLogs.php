<?php

namespace App\KhadamatTeck\Base\Models;

use App\KhadamatTeck\Base\BaseModel;

class CronLogs extends BaseModel
{

    protected $fillable
        = [
            'run_at',
            'cron_name',
            'meta'
        ];
    protected $casts
        = [
            'meta' => 'array',
        ];
}
