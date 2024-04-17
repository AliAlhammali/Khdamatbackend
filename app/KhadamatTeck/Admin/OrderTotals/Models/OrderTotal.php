<?php

namespace App\KhadamatTeck\Admin\OrderTotals\Models;

use App\KhadamatTeck\Base\BaseModel;

class OrderTotal extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_totals';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'order_id', 'merchant_id', 'merchant_user_id', 'item_id', 'quantity', 'item_price', 'order_otp', 'merchant_user_commission_total', 'merchant_user_commission_sup_total', 'merchant_user_commission_vat', 'sp_total', 'sp_sup_total', 'sp_vat', 'sup_total', 'vat', 'total'];
}
