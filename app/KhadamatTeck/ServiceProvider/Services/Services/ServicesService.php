<?php

namespace App\KhadamatTeck\ServiceProvider\Services\Services;

use App\KhadamatTeck\Admin\Services\Mappers\ServiceDTOMapper;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\ServiceProvider\Services\Repositories\ServicesRepository;
use App\KhadamatTeck\ServiceProvider\Services\Requests\CreateServiceRequest;
use App\KhadamatTeck\ServiceProvider\Services\Requests\DeleteServiceRequest;
use App\KhadamatTeck\ServiceProvider\Services\Requests\ListServiceRequest;
use App\KhadamatTeck\ServiceProvider\Services\Requests\UpdateServiceRequest;
use App\KhadamatTeck\ServiceProvider\Services\Requests\ViewServiceRequest;

class ServicesService extends Service
{
    /**
     * @var ServicesRepository $servicesRepository
     * AE
     */
    private ServicesRepository $servicesRepository;

    public function __construct(ServicesRepository $servicesRepository)
    {
        parent::__construct($servicesRepository);
        $this->servicesRepository = $servicesRepository;
    }

    public function paginateServices(ListServiceRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->servicesRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->servicesRepository->paginateServices(
                $request->query(),
                $request->query('perPage')
            );
            $data = ServiceDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createService(CreateServiceRequest $request): Response
    {
        $data = $this->servicesRepository->createService($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateService(UpdateServiceRequest $request, $id): Response
    {
        $model = $this->servicesRepository->findService($id);
        $data = $this->servicesRepository->updateService(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteService(DeleteServiceRequest $request, $id): Response
    {
        $model = $this->servicesRepository->findService($id);
        return $this->response()
            ->setData($this->servicesRepository->deleteService($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findService(ViewServiceRequest $request, $id): Response
    {
        $model = $this->servicesRepository->findService($id);
        $data = ServiceDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
