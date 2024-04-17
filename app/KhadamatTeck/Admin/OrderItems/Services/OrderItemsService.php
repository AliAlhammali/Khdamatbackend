<?php

namespace App\KhadamatTeck\Admin\OrderItems\Services;

use App\KhadamatTeck\Admin\OrderItems\Mappers\OrderItemDTOMapper;
use App\KhadamatTeck\Admin\OrderItems\Repositories\OrderItemsRepository;
use App\KhadamatTeck\Admin\OrderItems\Requests\CreateOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\DeleteOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\ListOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\UpdateOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\ViewOrderItemRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class OrderItemsService extends Service
{
    /**
     * @var OrderItemsRepository $orderItemsRepository
     * AE
     */
    private OrderItemsRepository $orderItemsRepository;

    public function __construct(OrderItemsRepository $orderItemsRepository)
    {
        parent::__construct($orderItemsRepository);
        $this->orderItemsRepository = $orderItemsRepository;
    }

    public function paginateOrderItems(ListOrderItemRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->orderItemsRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->orderItemsRepository->paginateOrderItems(
                $request->query(),
                $request->query('perPage')
            );
            $data = OrderItemDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createOrderItem(CreateOrderItemRequest $request): Response
    {
        $data = $this->orderItemsRepository->createOrderItem($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateOrderItem(UpdateOrderItemRequest $request, $id): Response
    {
        $model = $this->orderItemsRepository->findOrderItem($id);
        $data = $this->orderItemsRepository->updateOrderItem(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteOrderItem(DeleteOrderItemRequest $request, $id): Response
    {
        $model = $this->orderItemsRepository->findOrderItem($id);
        return $this->response()
            ->setData($this->orderItemsRepository->deleteOrderItem($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findOrderItem(ViewOrderItemRequest $request, $id): Response
    {
        $model = $this->orderItemsRepository->findOrderItem($id);
        $data = OrderItemDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
