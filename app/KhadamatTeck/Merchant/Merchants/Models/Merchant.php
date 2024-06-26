<?php

namespace App\KhadamatTeck\Merchant\Merchants\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\Admin\Orders\Models\Order;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use Smartisan\Settings\HasSettings;
use Spatie\QueryBuilder\AllowedFilter;

class Merchant extends BaseModel
{
    use HasSettings;
    use \Laravel\Passport\HasApiTokens, \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Notifications\Notifiable;

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchants';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'title', 'description', 'status', 'address', 'email', 'phone', 'logo', 'vat_file', 'cr_file', 'sales_agreement_file', 'cr_number', 'vat_number','code'];

    public function users()
    {
        return $this->hasMany(MerchantUser::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceModel::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['title', 'phone'])),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('title'),
            AllowedFilter::exact('address'),
            AllowedFilter::exact('email'),
            AllowedFilter::exact('phone'),
            AllowedFilter::exact('code'),
            AllowedFilter::exact('id'),
        ];
    }
}
