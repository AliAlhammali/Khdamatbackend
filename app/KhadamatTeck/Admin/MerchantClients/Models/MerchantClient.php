<?php

namespace App\KhadamatTeck\Admin\MerchantClients\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use Illuminate\Database\Eloquent\SoftDeletes;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\QueryBuilder\AllowedFilter;

class MerchantClient extends BaseModel
{
    use SoftDeletes;
    use HasSpatial;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant_clients';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'location', 'name', 'merchant_id', 'email', 'address', 'phone', 'is_active'];

    protected $casts = [
        'location' => Point::class,
        'is_active' => 'boolean',
    ];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('merchant_id'),
            AllowedFilter::exact('name'),
            AllowedFilter::exact('email'),
            AllowedFilter::exact('address'),
            AllowedFilter::exact('phone'),
            AllowedFilter::exact('is_active'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['name', 'phone'])),
        ];
    }
}
