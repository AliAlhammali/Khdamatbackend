<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Smartisan\Settings\HasSettings;

class ServiceProvider extends BaseModel
{
    use HasSettings;

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_providers';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'title', 'description', 'status', 'address', 'phone', 'logo', 'vat_file', 'cr_file', 'sales_agreement_file', 'cr_number', 'vat_number'];

    public function users()
    {
        return $this->hasMany(ServiceProviderUser::class);
    }
}
