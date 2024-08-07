<?php

namespace App\KhadamatTeck\Admin\MerchantUsers\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\CreateMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\DeleteMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\ListMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\UpdateMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\ViewMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Services\MerchantUsersService;
use App\KhadamatTeck\Base\Response;

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
