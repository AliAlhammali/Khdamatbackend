<?php

namespace App\KhadamatTeck\Admin\Merchants\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\Merchants\Requests\CreateMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\DeleteMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\ListMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\UpdateMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\ViewMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Services\MerchantsService;
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
