<?php

namespace App\KhadamatTeck\Public\Merchants\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Public\Merchants\Requests\ViewMerchantRequest;
use App\KhadamatTeck\Public\Merchants\Services\MerchantsService;
use App\KhadamatTeck\Base\Response;

class MerchantsController extends Controller
{
    /**
     * @var MerchantsService $merchantsService
     */
    private MerchantsService $merchantsService;

    public function __construct(MerchantsService $merchantsService)
    {
        $this->merchantsService = $merchantsService;
    }

    public function getByCode(ViewMerchantRequest $request,string $code)
    {
        return $this->merchantsService->getByCode($request,$code);
    }
}
