<?php

namespace App\KhadamatTeck\Admin\ServiceProviderUsers\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\CreateServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\DeleteServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\ListServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\UpdateServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\ViewServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Services\ServiceProviderUsersService;
use App\KhadamatTeck\Base\Response;

class ServiceProviderUsersController extends Controller
{
    /**
     * @var ServiceProviderUsersService $serviceProviderUsersService
     */
    private ServiceProviderUsersService $serviceProviderUsersService;

    public function __construct(ServiceProviderUsersService $serviceProviderUsersService)
    {
        $this->serviceProviderUsersService = $serviceProviderUsersService;
    }

    public function index(ListServiceProviderUserRequest $request)
    {
        return $this->serviceProviderUsersService->paginateServiceProviderUsers($request);
    }

    public function create(CreateServiceProviderUserRequest $request)
    {
        return $this->serviceProviderUsersService->createServiceProviderUser($request);
    }


    public function show(ViewServiceProviderUserRequest $request, string $id): Response
    {
        return $this->serviceProviderUsersService->findServiceProviderUser($request, $id);
    }

    public function update(UpdateServiceProviderUserRequest $request, string $id)
    {
        return $this->serviceProviderUsersService->updateServiceProviderUser($request, $id);
    }

    public function delete(DeleteServiceProviderUserRequest $request, string $id)
    {
        return $this->serviceProviderUsersService->deleteServiceProviderUser($request, $id);
    }
}
