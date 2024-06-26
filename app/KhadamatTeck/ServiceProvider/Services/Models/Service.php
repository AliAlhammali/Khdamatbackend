<?php

namespace App\KhadamatTeck\ServiceProvider\Services\Models;

use App\KhadamatTeck\Base\BaseModel;

class Service extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'title', 'slug', 'description', 'status', 'merchant_id', 'category_id'];
}
