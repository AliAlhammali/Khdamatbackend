<?php

namespace App\KhadamatTeck\Admin\ServiceProviderUsers\Services;

use App\KhadamatTeck\Admin\ServiceProviderUsers\Repositories\ServiceProviderUsersRepository;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\CreateServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\DeleteServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\ListServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\UpdateServiceProviderUserRequest;
use App\KhadamatTeck\Admin\ServiceProviderUsers\Requests\ViewServiceProviderUserRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Mappers\ServiceProviderUserDTOMapper;

class ServiceProviderUsersService extends Service
{
    /**
     * @var ServiceProviderUsersRepository $serviceProviderUsersRepository
     * AE
     */
    private ServiceProviderUsersRepository $serviceProviderUsersRepository;

    public function __construct(ServiceProviderUsersRepository $serviceProviderUsersRepository)
    {
        parent::__construct($serviceProviderUsersRepository);
        $this->serviceProviderUsersRepository = $serviceProviderUsersRepository;
    }

    public function paginateServiceProviderUsers(ListServiceProviderUserRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->serviceProviderUsersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->serviceProviderUsersRepository->paginateServiceProviderUsers(
                $request->query(),
                $request->query('perPage')
            );
            $data = ServiceProviderUserDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createServiceProviderUser(CreateServiceProviderUserRequest $request): Response
    {
        $data = $this->serviceProviderUsersRepository->createServiceProviderUser($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateServiceProviderUser(UpdateServiceProviderUserRequest $request, $id): Response
    {
        $model = $this->serviceProviderUsersRepository->findServiceProviderUser($id);
        $data = $this->serviceProviderUsersRepository->updateServiceProviderUser(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteServiceProviderUser(DeleteServiceProviderUserRequest $request, $id): Response
    {
        $model = $this->serviceProviderUsersRepository->findServiceProviderUser($id);
        return $this->response()
            ->setData($this->serviceProviderUsersRepository->deleteServiceProviderUser($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findServiceProviderUser(ViewServiceProviderUserRequest $request, $id): Response
    {
        $model = $this->serviceProviderUsersRepository->findServiceProviderUser($id);
        $data = ServiceProviderUserDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
