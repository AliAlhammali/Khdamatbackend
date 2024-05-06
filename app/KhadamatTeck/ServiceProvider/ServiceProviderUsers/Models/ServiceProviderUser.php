<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models;

use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Base\Scopes\OwnSPData;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;
#[ScopedBy([OwnSPData::class])]
class ServiceProviderUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_provider_users';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'name', 'service_provider_id', 'email', 'address', 'phone', 'role', 'password', 'status'];

    function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('service_provider_id'),
            AllowedFilter::exact('role'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['name', 'phone'])),
        ];
    }

    public static function getDefaultSort()
    {
        if (request('sortAsc', false)) {
            return 'created_at';
        } else {
            return '-created_at';
        }
    }

    public static function getAllowedSorts()
    {
        if (request('sortAsc', false)) {
            return 'created_at';
        } else {
            return '-created_at';
        }
    }

}
