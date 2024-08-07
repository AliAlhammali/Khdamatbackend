<?php

namespace App\KhadamatTeck\Admin\OrderTotals\Services;

use App\KhadamatTeck\Admin\OrderTotals\Mappers\OrderTotalDTOMapper;
use App\KhadamatTeck\Admin\OrderTotals\Repositories\OrderTotalsRepository;
use App\KhadamatTeck\Admin\OrderTotals\Requests\CreateOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\DeleteOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\ListOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\UpdateOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\ViewOrderTotalRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class OrderTotalsService extends Service
{
    /**
     * @var OrderTotalsRepository $orderTotalsRepository
     * AE
     */
    private OrderTotalsRepository $orderTotalsRepository;

    public function __construct(OrderTotalsRepository $orderTotalsRepository)
    {
        parent::__construct($orderTotalsRepository);
        $this->orderTotalsRepository = $orderTotalsRepository;
    }

    public function paginateOrderTotals(ListOrderTotalRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->orderTotalsRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->orderTotalsRepository->paginateOrderTotals(
                $request->query(),
                $request->query('perPage')
            );
            $data = OrderTotalDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createOrderTotal(CreateOrderTotalRequest $request): Response
    {
        $data = $this->orderTotalsRepository->createOrderTotal($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateOrderTotal(UpdateOrderTotalRequest $request, $id): Response
    {
        $model = $this->orderTotalsRepository->findOrderTotal($id);
        $data = $this->orderTotalsRepository->updateOrderTotal(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteOrderTotal(DeleteOrderTotalRequest $request, $id): Response
    {
        $model = $this->orderTotalsRepository->findOrderTotal($id);
        return $this->response()
            ->setData($this->orderTotalsRepository->deleteOrderTotal($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findOrderTotal(ViewOrderTotalRequest $request, $id): Response
    {
        $model = $this->orderTotalsRepository->findOrderTotal($id);
        $data = OrderTotalDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
