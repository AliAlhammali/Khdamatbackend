<?php

namespace App\KhadamatTeck\ServiceProvider\Dashboard\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboards';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [];
}
