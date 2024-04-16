<?php
namespace App\KhadamatTeck\Admin\MerchantBranches\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\CreateMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\DeleteMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\ListMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\UpdateMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\ViewMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Services\MerchantBranchesService;

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

    public function update(UpdateMerchantBranchRequest $request,string $id)
    {
        return $this->merchantBranchesService->updateMerchantBranch($request,$id);
    }

    public function delete(DeleteMerchantBranchRequest $request,string $id)
    {
        return $this->merchantBranchesService->deleteMerchantBranch($request,$id);
    }
}
