<?php

namespace App\KhadamatTeck\Public\Merchants\Repositories;

use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Merchant\Merchants\Mappers\MerchantDTOMapper;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class MerchantsRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Merchant());
    }

    public function findMerchantByCode(string $code)
    {
        return Merchant::where(['code' => $code])->firstOrFail();
    }
}
