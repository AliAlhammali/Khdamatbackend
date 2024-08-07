<?php

namespace App\KhadamatTeck\Client\Services\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Scopes\OwnMerchantClientData;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
#[ScopedBy([OwnMerchantClientData::class])]
class ServiceModel extends \App\KhadamatTeck\Admin\Services\Models\ServiceModel
{

}
