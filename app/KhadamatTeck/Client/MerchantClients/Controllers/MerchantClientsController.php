<?php

namespace App\KhadamatTeck\Client\MerchantClients\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Client\MerchantClients\Requests\CreateMerchantClientRequest;
use App\KhadamatTeck\Client\MerchantClients\Requests\DeleteMerchantClientRequest;
use App\KhadamatTeck\Client\MerchantClients\Requests\ListMerchantClientRequest;
use App\KhadamatTeck\Client\MerchantClients\Requests\UpdateMerchantClientRequest;
use App\KhadamatTeck\Client\MerchantClients\Requests\ViewMerchantClientRequest;
use App\KhadamatTeck\Client\MerchantClients\Services\MerchantClientsService;

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
