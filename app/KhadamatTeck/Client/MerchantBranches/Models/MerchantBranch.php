<?php

namespace App\KhadamatTeck\Client\MerchantBranches\Models;

use App\KhadamatTeck\Admin\MerchantBranches\Scopes\OwnBranches;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Base\Scopes\OwnMerchantClientData;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\QueryBuilder\AllowedFilter;
#[ScopedBy([OwnMerchantClientData::class])]
class MerchantBranch extends \App\KhadamatTeck\Admin\MerchantBranches\Models\MerchantBranch
{

}
