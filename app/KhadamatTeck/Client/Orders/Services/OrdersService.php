<?php

namespace App\KhadamatTeck\Client\Orders\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Admin\Orders\Mappers\OrderDTOMapper;
use App\KhadamatTeck\Client\Orders\Models\Order;
use App\KhadamatTeck\Client\Orders\Repositories\OrdersRepository;
use App\KhadamatTeck\Client\Orders\Requests\CreateOrderRequest;
use App\KhadamatTeck\Client\Orders\Requests\DeleteOrderRequest;
use App\KhadamatTeck\Client\Orders\Requests\ListOrderRequest;
use App\KhadamatTeck\Client\Orders\Requests\UpdateOrderRequest;
use App\KhadamatTeck\Client\Orders\Requests\ViewOrderRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class OrdersService extends Service
{
    /**
     * @var OrdersRepository $ordersRepository
     * AE
     */
    private OrdersRepository $ordersRepository;

    public function __construct(OrdersRepository $ordersRepository)
    {
        parent::__construct($ordersRepository);
        $this->ordersRepository = $ordersRepository;
    }

    public function paginateOrders(ListOrderRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->ordersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->ordersRepository->paginateOrders(
                $request->query(),
                $request->query('perPage')
            );
            $data = OrderDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createOrder(CreateOrderRequest $request): Response
    {
        $data = $request->all();
//
//        dd($data['address']);
        DB::beginTransaction();
        try {
            $order = Order::create($request->all());
            $order->address()->create($data['address']);
            $order->items()->createMany($data['items']);
            $order->total()->create($data['totals']);

            DB::commit();
            // all good
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $this->response()
            ->setData(OrderDTOMapper::fromModel($order->fresh()))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateOrder(UpdateOrderRequest $request, $id): Response
    {
        $model = $this->ordersRepository->findOrder($id);
        $data = $this->ordersRepository->updateOrder(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteOrder(DeleteOrderRequest $request, $id): Response
    {
        $model = $this->ordersRepository->findOrder($id);
        return $this->response()
            ->setData($this->ordersRepository->deleteOrder($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findOrder(ViewOrderRequest $request, $id): Response
    {
        $model = $this->ordersRepository->findOrder($id);
        $data = OrderDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
