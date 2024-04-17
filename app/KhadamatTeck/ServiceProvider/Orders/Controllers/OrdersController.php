<?php

namespace App\KhadamatTeck\ServiceProvider\Orders\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\ServiceProvider\Orders\Requests\CreateOrderRequest;
use App\KhadamatTeck\ServiceProvider\Orders\Requests\DeleteOrderRequest;
use App\KhadamatTeck\ServiceProvider\Orders\Requests\ListOrderRequest;
use App\KhadamatTeck\ServiceProvider\Orders\Requests\UpdateOrderRequest;
use App\KhadamatTeck\ServiceProvider\Orders\Requests\ViewOrderRequest;
use App\KhadamatTeck\ServiceProvider\Orders\Services\OrdersService;

class OrdersController extends Controller
{
    /**
     * @var OrdersService $ordersService
     */
    private OrdersService $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function index(ListOrderRequest $request)
    {
        return $this->ordersService->paginateOrders($request);
    }

    public function create(CreateOrderRequest $request)
    {
        return $this->ordersService->createOrder($request);
    }


    public function show(ViewOrderRequest $request, string $id): Response
    {
        return $this->ordersService->findOrder($request, $id);
    }

    public function update(UpdateOrderRequest $request, string $id)
    {
        return $this->ordersService->updateOrder($request, $id);
    }

    public function delete(DeleteOrderRequest $request, string $id)
    {
        return $this->ordersService->deleteOrder($request, $id);
    }
}
