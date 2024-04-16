<?php

namespace App\KhadamatTeck\Admin\OrderAddress\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAddress extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_addresses';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id','order_id','name','email','phone','address','vat','location','pick_up_location','is_default_address'];
}
