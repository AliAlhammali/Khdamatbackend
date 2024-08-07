<?php

namespace App\KhadamatTeck\ServiceProvider\Orders\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Admin\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use App\KhadamatTeck\Admin\OrderItems\Models\OrderItem;
use App\KhadamatTeck\Admin\OrderTotals\Models\OrderTotal;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Scopes\OwnMerchantData;
use App\KhadamatTeck\Base\Scopes\OwnSPData;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([OwnSPData::class])]
class Order extends \App\KhadamatTeck\Admin\Orders\Models\Order
{


}
