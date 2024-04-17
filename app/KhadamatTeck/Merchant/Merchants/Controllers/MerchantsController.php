<?php

namespace App\KhadamatTeck\Merchant\Merchants\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Merchant\Merchants\Requests\CreateMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Requests\DeleteMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Requests\ListMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Requests\UpdateMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Requests\ViewMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Services\MerchantsService;

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

    public function index(ListMerchantRequest $request)
    {
        return $this->merchantsService->paginateMerchants($request);
    }

    public function create(CreateMerchantRequest $request)
    {
        return $this->merchantsService->createMerchant($request);
    }


    public function show(ViewMerchantRequest $request, string $id): Response
    {
        return $this->merchantsService->findMerchant($request, $id);
    }

    public function update(UpdateMerchantRequest $request, string $id)
    {
        return $this->merchantsService->updateMerchant($request, $id);
    }

    public function delete(DeleteMerchantRequest $request, string $id)
    {
        return $this->merchantsService->deleteMerchant($request, $id);
    }
}
