<?php

namespace App\KhadamatTeck\Admin\Orders\Models;

use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use App\KhadamatTeck\Admin\OrderItems\Models\OrderItem;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;

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

    protected $fillable = ['id', 'merchant_id', 'merchant_user_id', 'merchant_client_id', 'main_category_id', 'category_id', 'status', 'order_otp', 'created_at', 'pick_up_type', 'merchant_branch_id', 'started_at', 'profit_sup_total', 'profit_vat', 'profit_total',];


    function address()
    {
        return $this->hasMany(OrderAddress::class);
    }

    function total()
    {
        return $this->hasOne(OrderTotal::class);
    }

    function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class);
    }

    function activeServiceProvider()
    {
        return $this->belongsTo(ServiceProvider::class)->where('active', 1);
    }

}