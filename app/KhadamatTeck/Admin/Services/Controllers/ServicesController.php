<?php

namespace App\KhadamatTeck\Admin\Services\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\Services\Requests\CreateServiceRequest;
use App\KhadamatTeck\Admin\Services\Requests\DeleteServiceRequest;
use App\KhadamatTeck\Admin\Services\Requests\ListServiceRequest;
use App\KhadamatTeck\Admin\Services\Requests\UpdateServiceRequest;
use App\KhadamatTeck\Admin\Services\Requests\ViewServiceRequest;
use App\KhadamatTeck\Admin\Services\Services\ServicesService;
use App\KhadamatTeck\Base\Response;

class ServicesController extends Controller
{
    /**
     * @var ServicesService $servicesService
     */
    private ServicesService $servicesService;

    public function __construct(ServicesService $servicesService)
    {
        $this->servicesService = $servicesService;
    }

    public function index(ListServiceRequest $request)
    {
        return $this->servicesService->paginateServices($request);
    }

    public function create(CreateServiceRequest $request)
    {
        return $this->servicesService->createService($request);
    }


    public function show(ViewServiceRequest $request, string $id): Response
    {
        return $this->servicesService->findService($request, $id);
    }

    public function update(UpdateServiceRequest $request, string $id)
    {
        return $this->servicesService->updateService($request, $id);
    }

    public function delete(DeleteServiceRequest $request, string $id)
    {
        return $this->servicesService->deleteService($request, $id);
    }
}
