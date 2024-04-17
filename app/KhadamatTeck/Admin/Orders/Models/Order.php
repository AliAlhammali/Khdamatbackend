<?php

namespace App\KhadamatTeck\Admin\Orders\Models;

use App\KhadamatTeck\Base\BaseModel;

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

    protected $fillable = ['id', 'merchant_id', 'merchant_user_id', 'merchant_client_id', 'main_category_id', 'category_id', 'status', 'order_otp', 'created_at', 'pick_up_type', 'merchant_branch_id', 'started_at', 'completed_at'];
}
