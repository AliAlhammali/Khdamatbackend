<?php
namespace App\KhadamatTeck\Admin\OrderServiceProviders\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\CreateOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\DeleteOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\ListOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\UpdateOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Requests\ViewOrderServiceProviderRequest;
use App\KhadamatTeck\Admin\OrderServiceProviders\Services\OrderServiceProvidersService;

class OrderServiceProvidersController extends Controller
{
    /**
     * @var OrderServiceProvidersService $orderServiceProvidersService
     */
    private OrderServiceProvidersService $orderServiceProvidersService;

    public function __construct(OrderServiceProvidersService $orderServiceProvidersService)
    {
        $this->orderServiceProvidersService = $orderServiceProvidersService;
    }

    public function index(ListOrderServiceProviderRequest $request)
    {
        return $this->orderServiceProvidersService->paginateOrderServiceProviders($request);
    }

    public function create(CreateOrderServiceProviderRequest $request)
    {
        return $this->orderServiceProvidersService->createOrderServiceProvider($request);
    }


    public function show(ViewOrderServiceProviderRequest $request, string $id): Response
    {
        return $this->orderServiceProvidersService->findOrderServiceProvider($request, $id);
    }

    public function update(UpdateOrderServiceProviderRequest $request,string $id)
    {
        return $this->orderServiceProvidersService->updateOrderServiceProvider($request,$id);
    }

    public function delete(DeleteOrderServiceProviderRequest $request,string $id)
    {
        return $this->orderServiceProvidersService->deleteOrderServiceProvider($request,$id);
    }
}
