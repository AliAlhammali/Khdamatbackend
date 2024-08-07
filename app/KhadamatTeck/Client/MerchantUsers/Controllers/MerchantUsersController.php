<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\CreateMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\DeleteMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\ListMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\UpdateMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Requests\ViewMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Services\MerchantUsersService;

class MerchantUsersController extends Controller
{
    /**
     * @var MerchantUsersService $merchantUsersService
     */
    private MerchantUsersService $merchantUsersService;

    public function __construct(MerchantUsersService $merchantUsersService)
    {
        $this->merchantUsersService = $merchantUsersService;
    }

    public function index(ListMerchantUserRequest $request)
    {
        return $this->merchantUsersService->paginateMerchantUsers($request);
    }

    public function create(CreateMerchantUserRequest $request)
    {
        return $this->merchantUsersService->createMerchantUser($request);
    }


    public function show(ViewMerchantUserRequest $request, string $id): Response
    {
        return $this->merchantUsersService->findMerchantUser($request, $id);
    }

    public function update(UpdateMerchantUserRequest $request, string $id)
    {
        return $this->merchantUsersService->updateMerchantUser($request, $id);
    }

    public function delete(DeleteMerchantUserRequest $request, string $id)
    {
        return $this->merchantUsersService->deleteMerchantUser($request, $id);
    }
}
