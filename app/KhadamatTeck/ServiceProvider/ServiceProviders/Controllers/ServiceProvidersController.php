<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\CreateServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\DeleteServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\ListServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\UpdateServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\ViewServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Services\ServiceProvidersService;

class ServiceProvidersController extends Controller
{
    /**
     * @var ServiceProvidersService $serviceProvidersService
     */
    private ServiceProvidersService $serviceProvidersService;

    public function __construct(ServiceProvidersService $serviceProvidersService)
    {
        $this->serviceProvidersService = $serviceProvidersService;
    }

    public function index(ListServiceProviderRequest $request)
    {
        return $this->serviceProvidersService->paginateServiceProviders($request);
    }

    public function create(CreateServiceProviderRequest $request)
    {
        return $this->serviceProvidersService->createServiceProvider($request);
    }


    public function show(ViewServiceProviderRequest $request, string $id): Response
    {
        return $this->serviceProvidersService->findServiceProvider($request, $id);
    }

    public function update(UpdateServiceProviderRequest $request, string $id)
    {
        return $this->serviceProvidersService->updateServiceProvider($request, $id);
    }

    public function delete(DeleteServiceProviderRequest $request, string $id)
    {
        return $this->serviceProvidersService->deleteServiceProvider($request, $id);
    }
}
