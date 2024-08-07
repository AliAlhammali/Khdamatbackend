<?php

namespace App\KhadamatTeck\Admin\OrderTotals\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\OrderTotals\Requests\CreateOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\DeleteOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\ListOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\UpdateOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Requests\ViewOrderTotalRequest;
use App\KhadamatTeck\Admin\OrderTotals\Services\OrderTotalsService;
use App\KhadamatTeck\Base\Response;

class OrderTotalsController extends Controller
{
    /**
     * @var OrderTotalsService $orderTotalsService
     */
    private OrderTotalsService $orderTotalsService;

    public function __construct(OrderTotalsService $orderTotalsService)
    {
        $this->orderTotalsService = $orderTotalsService;
    }

    public function index(ListOrderTotalRequest $request)
    {
        return $this->orderTotalsService->paginateOrderTotals($request);
    }

    public function create(CreateOrderTotalRequest $request)
    {
        return $this->orderTotalsService->createOrderTotal($request);
    }


    public function show(ViewOrderTotalRequest $request, string $id): Response
    {
        return $this->orderTotalsService->findOrderTotal($request, $id);
    }

    public function update(UpdateOrderTotalRequest $request, string $id)
    {
        return $this->orderTotalsService->updateOrderTotal($request, $id);
    }

    public function delete(DeleteOrderTotalRequest $request, string $id)
    {
        return $this->orderTotalsService->deleteOrderTotal($request, $id);
    }
}
