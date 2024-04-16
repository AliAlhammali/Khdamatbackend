<?php

namespace App\KhadamatTeck\Admin\MerchantBranches\Models;

use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class MerchantBranch extends BaseModel
{
    use SoftDeletes;
    use HasSpatial;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant_branches';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id','location','name','merchant_id','address','is_active'];

    protected $casts = [
        'location' => Point::class,
        'is_active' => 'boolean',
    ];
}
