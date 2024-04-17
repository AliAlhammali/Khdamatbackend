<?php

namespace App\KhadamatTeck\Admin\OrderAddress\Models;

use App\KhadamatTeck\Base\BaseModel;
use MatanYadaev\EloquentSpatial\Objects\Point;

class OrderAddress extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_address';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'order_id', 'name', 'email', 'phone', 'address', 'vat', 'location', 'pick_up_location', 'is_default_address'];

    protected $casts = [
        'location' => Point::class,
        'pick_up_location' => Point::class,
    ];
}
