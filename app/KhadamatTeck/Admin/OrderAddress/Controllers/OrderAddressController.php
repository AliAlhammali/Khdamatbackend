<?php
namespace App\KhadamatTeck\Admin\OrderAddress\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\OrderAddress\Requests\CreateOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\DeleteOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\ListOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\UpdateOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\ViewOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Services\OrderAddressService;

class OrderAddressController extends Controller
{
    /**
     * @var OrderAddressService $orderAddressService
     */
    private OrderAddressService $orderAddressService;

    public function __construct(OrderAddressService $orderAddressService)
    {
        $this->orderAddressService = $orderAddressService;
    }

    public function index(ListOrderAddressRequest $request)
    {
        return $this->orderAddressService->paginateOrderAddress($request);
    }

    public function create(CreateOrderAddressRequest $request)
    {
        return $this->orderAddressService->createOrderAddress($request);
    }


    public function show(ViewOrderAddressRequest $request, string $id): Response
    {
        return $this->orderAddressService->findOrderAddress($request, $id);
    }

    public function update(UpdateOrderAddressRequest $request,string $id)
    {
        return $this->orderAddressService->updateOrderAddress($request,$id);
    }

    public function delete(DeleteOrderAddressRequest $request,string $id)
    {
        return $this->orderAddressService->deleteOrderAddress($request,$id);
    }
}
