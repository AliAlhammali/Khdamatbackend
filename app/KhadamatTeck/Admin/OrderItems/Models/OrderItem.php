<?php

namespace App\KhadamatTeck\Admin\OrderItems\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id','order_id','item_id','quantity','item_price','sup_total','vat','total','order_otp'];
}
