<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Smartisan\Settings\HasSettings;
use Spatie\QueryBuilder\AllowedFilter;

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

    protected $fillable = ['id', 'title','email', 'description', 'status', 'address', 'phone', 'logo', 'vat_file', 'cr_file', 'sales_agreement_file', 'cr_number', 'vat_number','can_collect_vat'];

    public function users()
    {
        return $this->hasMany(ServiceProviderUser::class);
    }

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('service_provider_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('role'),
            AllowedFilter::exact('id'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['title', 'phone'])),
        ];
    }
}
