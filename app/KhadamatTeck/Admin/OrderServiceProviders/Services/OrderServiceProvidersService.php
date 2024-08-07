<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\Services;

use App\KhadamatTeck\Admin\OrderServiceProviders\Mappers\OrderServiceProviderDTOMapper;
use App\KhadamatTeck\Admin\OrderServiceProviders\Repositories\OrderServiceProvidersRepository;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\CreateOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\DeleteOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\ListOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\UpdateOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\ViewOrderServiceProviderRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class OrderServiceProvidersService extends Service
{
    /**
     * @var OrderServiceProvidersRepository $orderServiceProvidersRepository
     * AE
     */
    private OrderServiceProvidersRepository $orderServiceProvidersRepository;

    public function __construct(OrderServiceProvidersRepository $orderServiceProvidersRepository)
    {
        parent::__construct($orderServiceProvidersRepository);
        $this->orderServiceProvidersRepository = $orderServiceProvidersRepository;
    }

    public function paginateOrderServiceProviders(ListOrderServiceProviderRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->orderServiceProvidersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->orderServiceProvidersRepository->paginateOrderServiceProviders(
                $request->query(),
                $request->query('perPage')
            );
            $data = OrderServiceProviderDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createOrderServiceProvider(CreateOrderServiceProviderRequest $request): Response
    {
        $data = $this->orderServiceProvidersRepository->createOrderServiceProvider($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateOrderServiceProvider(UpdateOrderServiceProviderRequest $request, $id): Response
    {
        $model = $this->orderServiceProvidersRepository->findOrderServiceProvider($id);
        $data = $this->orderServiceProvidersRepository->updateOrderServiceProvider(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteOrderServiceProvider(DeleteOrderServiceProviderRequest $request, $id): Response
    {
        $model = $this->orderServiceProvidersRepository->findOrderServiceProvider($id);
        return $this->response()
            ->setData($this->orderServiceProvidersRepository->deleteOrderServiceProvider($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findOrderServiceProvider(ViewOrderServiceProviderRequest $request, $id): Response
    {
        $model = $this->orderServiceProvidersRepository->findOrderServiceProvider($id);
        $data = OrderServiceProviderDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
