<?php

namespace App\KhadamatTeck\Merchant\Merchants\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\QueryBuilder\AllowedFilter;

class Merchant extends BaseModel
{
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

    protected $fillable = ['id', 'title', 'description', 'status', 'address', 'phone', 'logo', 'vat_file', 'cr_file', 'sales_agreement_file', 'cr_number', 'vat_number'];

    public function users()
    {
        $this->hasMany(MerchantUser::class);
    }

    public function categories()
    {
        $this->hasMany(Category::class);
    }

    public function services()
    {
        $this->hasMany(ServiceModel::class);
    }
}
