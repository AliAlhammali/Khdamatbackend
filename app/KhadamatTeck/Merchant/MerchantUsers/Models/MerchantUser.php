<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Models;

use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;
#[ScopedBy([OwnMerchantData::class])]
class MerchantUser extends \App\KhadamatTeck\Admin\MerchantUsers\Models\MerchantUser
{

}
