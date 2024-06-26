<?php

namespace App\KhadamatTeck\Admin\MerchantClients\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\MerchantClients\Requests\CreateMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\DeleteMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\ListMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\UpdateMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\ViewMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Services\MerchantClientsService;
use App\KhadamatTeck\Base\Response;

class MerchantClientsController extends Controller
{
    /**
     * @var MerchantClientsService $merchantClientsService
     */
    private MerchantClientsService $merchantClientsService;

    public function __construct(MerchantClientsService $merchantClientsService)
    {
        $this->merchantClientsService = $merchantClientsService;
    }

    public function index(ListMerchantClientRequest $request)
    {
        return $this->merchantClientsService->paginateMerchantClients($request);
    }

    public function create(CreateMerchantClientRequest $request)
    {
        return $this->merchantClientsService->createMerchantClient($request);
    }


    public function show(ViewMerchantClientRequest $request, string $id): Response
    {
        return $this->merchantClientsService->findMerchantClient($request, $id);
    }

    public function update(UpdateMerchantClientRequest $request, string $id)
    {
        return $this->merchantClientsService->updateMerchantClient($request, $id);
    }

    public function delete(DeleteMerchantClientRequest $request, string $id)
    {
        return $this->merchantClientsService->deleteMerchantClient($request, $id);
    }
}
