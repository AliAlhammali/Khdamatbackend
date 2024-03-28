<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;

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

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('service_provider_id'),
        ];
    }
}
