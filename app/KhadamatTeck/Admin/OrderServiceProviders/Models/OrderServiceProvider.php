<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\Models;

use App\KhadamatTeck\Base\BaseModel;

class OrderServiceProvider extends BaseModel
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_service_providers';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'order_id', 'service_provider_id', 'active'];
}
