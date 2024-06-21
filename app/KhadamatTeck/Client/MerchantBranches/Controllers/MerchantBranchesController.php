<?php

namespace App\KhadamatTeck\Client\MerchantBranches\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Client\MerchantBranches\Requests\CreateMerchantBranchRequest;
use App\KhadamatTeck\Client\MerchantBranches\Requests\DeleteMerchantBranchRequest;
use App\KhadamatTeck\Client\MerchantBranches\Requests\ListMerchantBranchRequest;
use App\KhadamatTeck\Client\MerchantBranches\Requests\UpdateMerchantBranchRequest;
use App\KhadamatTeck\Client\MerchantBranches\Requests\ViewMerchantBranchRequest;
use App\KhadamatTeck\Client\MerchantBranches\Services\MerchantBranchesService;

class MerchantBranchesController extends Controller
{
    /**
     * @var MerchantBranchesService $merchantBranchesService
     */
    private MerchantBranchesService $merchantBranchesService;

    public function __construct(MerchantBranchesService $merchantBranchesService)
    {
        $this->merchantBranchesService = $merchantBranchesService;
    }

    public function index(ListMerchantBranchRequest $request)
    {
        return $this->merchantBranchesService->paginateMerchantBranches($request);
    }

    public function create(CreateMerchantBranchRequest $request)
    {
        return $this->merchantBranchesService->createMerchantBranch($request);
    }


    public function show(ViewMerchantBranchRequest $request, string $id): Response
    {
        return $this->merchantBranchesService->findMerchantBranch($request, $id);
    }

    public function update(UpdateMerchantBranchRequest $request, string $id)
    {
        return $this->merchantBranchesService->updateMerchantBranch($request, $id);
    }

    public function delete(DeleteMerchantBranchRequest $request, string $id)
    {
        return $this->merchantBranchesService->deleteMerchantBranch($request, $id);
    }
}
