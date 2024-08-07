<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Mappers\ServiceProviderDTOMapper;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Repositories\ServiceProvidersRepository;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\CreateServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\DeleteServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\ListServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\UpdateServiceProviderRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Requests\ViewServiceProviderRequest;

class ServiceProvidersService extends Service
{
    /**
     * @var ServiceProvidersRepository $serviceProvidersRepository
     * AE
     */
    private ServiceProvidersRepository $serviceProvidersRepository;

    public function __construct(ServiceProvidersRepository $serviceProvidersRepository)
    {
        parent::__construct($serviceProvidersRepository);
        $this->serviceProvidersRepository = $serviceProvidersRepository;
    }

    public function paginateServiceProviders(ListServiceProviderRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->serviceProvidersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->serviceProvidersRepository->paginateServiceProviders(
                $request->query(),
                $request->query('perPage')
            );
            $data = ServiceProviderDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createServiceProvider(CreateServiceProviderRequest $request): Response
    {
        $data = $this->serviceProvidersRepository->createServiceProvider($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateServiceProvider(UpdateServiceProviderRequest $request, $id): Response
    {
        $model = $this->serviceProvidersRepository->findServiceProvider($id);
        $data = $this->serviceProvidersRepository->updateServiceProvider(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteServiceProvider(DeleteServiceProviderRequest $request, $id): Response
    {
        $model = $this->serviceProvidersRepository->findServiceProvider($id);
        return $this->response()
            ->setData($this->serviceProvidersRepository->deleteServiceProvider($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findServiceProvider(ViewServiceProviderRequest $request, $id): Response
    {
        $model = $this->serviceProvidersRepository->findServiceProvider($id);
        $data = ServiceProviderDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
