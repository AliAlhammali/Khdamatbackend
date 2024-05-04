<?php

namespace App\KhadamatTeck\Merchant\MerchantClients\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\QueryBuilder\AllowedFilter;
#[ScopedBy([OwnMerchantData::class])]
class MerchantClient extends \App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient
{

}
