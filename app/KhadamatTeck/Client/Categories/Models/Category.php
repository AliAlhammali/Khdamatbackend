<?php

namespace App\KhadamatTeck\Client\Categories\Models;

use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Scopes\OwnMerchantClientData;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
#[ScopedBy([OwnMerchantClientData::class])]
class Category extends \App\KhadamatTeck\Admin\Categories\Models\Category
{

}
