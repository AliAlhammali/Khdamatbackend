<?php

namespace App\KhadamatTeck\Admin\Orders\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Admin\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use App\KhadamatTeck\Admin\OrderItems\Models\OrderItem;
use App\KhadamatTeck\Admin\Orders\Events\OrderSpAssigned;
use App\KhadamatTeck\Admin\Orders\Events\OrderSpUserAssigned;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Kleemans\AttributeEvents;
use Spatie\QueryBuilder\AllowedFilter;

class Order extends BaseModel
{
    // use SoftDeletes;
    use AttributeEvents;
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

    protected $fillable = ['id', 'merchant_id', 'merchant_user_id', 'merchant_client_id', 'main_category_id', 'category_id', 'status', 'order_otp', 'created_at', 'pick_up_type', 'merchant_branch_id', 'started_at', 'profit_sup_total', 'profit_vat', 'profit_total','service_provider_id','service_provider_user_id', 'order_otp'];

        protected $dispatchesEvents = [
            'service_provider_id:*' => OrderSpAssigned::class,
            'service_provider_user_id:*' => OrderSpAssigned::class,
        ];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('service_provider_id'),
            AllowedFilter::exact('service_provider_user_id'),
            AllowedFilter::exact('merchant_branch_id'),
            AllowedFilter::exact('category_id'),
            AllowedFilter::exact('main_category_id'),
            AllowedFilter::exact('merchant_client_id'),
            AllowedFilter::exact('merchant_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::scope('date_from', 'createdFrom'),
            AllowedFilter::scope('date_to', 'createdTo'),
        ];
    }

    public function scopeCreatedFrom(Builder $query, $date): Builder
    {
        return $query->where(
            'orders.created_at',
            '>=',
            Carbon::parse($date . ' 00:00:00')
        );
    }

    public function scopeCreatedTo(Builder $query, $date): Builder
    {
        return $query->where(
            'orders.created_at',
            '<=',
            Carbon::parse($date . ' 23:59:59')
        );
    }
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
        return '-started_at';
//        if (request('sortAsc', false)) {
//            return 'started_at';
//        } else {
//            return '-started_at';
//        }
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
        return $this->belongsTo(ServiceProvider::class);
    }
    function serviceProviderUser()
    {
        return $this->belongsTo(ServiceProviderUser::class);
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
    function category()
    {
        return $this->belongsTo(Category::class);
    }

}
