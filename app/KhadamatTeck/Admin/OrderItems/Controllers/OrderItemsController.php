<?php
namespace App\KhadamatTeck\Admin\OrderItems\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\OrderItems\Requests\CreateOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\DeleteOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\ListOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\UpdateOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Requests\ViewOrderItemRequest;
use App\KhadamatTeck\Admin\OrderItems\Services\OrderItemsService;

class OrderItemsController extends Controller
{
    /**
     * @var OrderItemsService $orderItemsService
     */
    private OrderItemsService $orderItemsService;

    public function __construct(OrderItemsService $orderItemsService)
    {
        $this->orderItemsService = $orderItemsService;
    }

    public function index(ListOrderItemRequest $request)
    {
        return $this->orderItemsService->paginateOrderItems($request);
    }

    public function create(CreateOrderItemRequest $request)
    {
        return $this->orderItemsService->createOrderItem($request);
    }


    public function show(ViewOrderItemRequest $request, string $id): Response
    {
        return $this->orderItemsService->findOrderItem($request, $id);
    }

    public function update(UpdateOrderItemRequest $request,string $id)
    {
        return $this->orderItemsService->updateOrderItem($request,$id);
    }

    public function delete(DeleteOrderItemRequest $request,string $id)
    {
        return $this->orderItemsService->deleteOrderItem($request,$id);
    }
}
