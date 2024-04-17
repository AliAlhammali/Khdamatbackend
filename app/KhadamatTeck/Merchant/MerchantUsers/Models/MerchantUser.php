<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Models;

use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;

class MerchantUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        ];
    }
}
