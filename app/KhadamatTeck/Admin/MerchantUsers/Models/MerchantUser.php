<?php

namespace App\KhadamatTeck\Admin\MerchantUsers\Models;

use App\KhadamatTeck\Base\BaseAuthModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;

class MerchantUser extends BaseAuthModel
{

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant_users';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'name', 'merchant_id', 'email', 'address', 'phone', 'role', 'password', 'status'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('merchant_id'),
            AllowedFilter::exact('name'),
            AllowedFilter::exact('email'),
            AllowedFilter::exact('address'),
            AllowedFilter::exact('phone'),
            AllowedFilter::exact('role'),
            AllowedFilter::exact('status'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['name', 'phone'])),
        ];
    }
}
