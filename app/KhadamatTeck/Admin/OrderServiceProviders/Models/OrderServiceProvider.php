<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;

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

    protected $fillable = ['id', 'order_id', 'service_provider_id', 'service_provider_user_id', 'active'];

    public function order()
    {
        $this->belongsTo('App\KhadamatTeck\Admin\Order', 'order_id');
    }

    public function serviceProvider()
    {
        $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }

    public function serviceUser()
    {
        $this->belongsTo(ServiceProviderUser::class, 'service_provider_user_id');
    }
}
