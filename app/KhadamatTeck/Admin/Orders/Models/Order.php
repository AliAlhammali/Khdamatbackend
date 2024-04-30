<?php

namespace App\KhadamatTeck\Admin\Orders\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use App\KhadamatTeck\Admin\OrderItems\Models\OrderItem;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
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

    public static function getDefaultSort()
    {
        if (request('sortAsc', false)) {
            return 'started_at';
        } else {
            return '-started_at';
        }
    }

    public static function getAllowedSorts()
    {
        return 'started_at';
        if (request('sortAsc', false)) {
            return 'started_at';
        } else {
            return '-started_at';
        }
    }

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

    function merchantUser()
    {
        return $this->belongsTo(MerchantUser::class,'merchant_user_id');
    }

    function merchantClient()
    {
        return $this->belongsTo(MerchantClient::class,'merchant_client_id');
    }

    function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    function mainCategory()
    {
        return $this->belongsTo(Category::class,'main_category_id');
    }

}
