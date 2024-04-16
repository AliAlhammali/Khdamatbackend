<?php

namespace App\KhadamatTeck\Admin\Orders\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [];
}
