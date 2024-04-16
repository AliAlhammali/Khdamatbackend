<?php
namespace App\KhadamatTeck\Admin\OrderAddress\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Admin\OrderAddress\Mappers\OrderAddressDTOMapper;
use App\KhadamatTeck\Admin\OrderAddress\Models\OrderAddress;
use App\KhadamatTeck\Admin\OrderAddress\Repositories\OrderAddressRepository;
use App\KhadamatTeck\Admin\OrderAddress\Requests\CreateOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\DeleteOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\ListOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\UpdateOrderAddressRequest;
use App\KhadamatTeck\Admin\OrderAddress\Requests\ViewOrderAddressRequest;

class OrderAddressService extends Service
{
    /**
     * @var OrderAddressRepository $orderAddressRepository
     * AE
     */
    private OrderAddressRepository $orderAddressRepository;

    public function __construct(OrderAddressRepository $orderAddressRepository)
    {
    parent::__construct($orderAddressRepository);
        $this->orderAddressRepository = $orderAddressRepository;
    }

    public function paginateOrderAddress(ListOrderAddressRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->orderAddressRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->orderAddressRepository->paginateOrderAddress(
                $request->query(),
                $request->query('perPage')
            );
            $data = OrderAddressDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createOrderAddress(CreateOrderAddressRequest $request): Response
    {
        $data  =$this->orderAddressRepository->createOrderAddress($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateOrderAddress(UpdateOrderAddressRequest $request,$id): Response
    {
        $model = $this->orderAddressRepository->findOrderAddress($id);
        $data = $this->orderAddressRepository->updateOrderAddress(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteOrderAddress(DeleteOrderAddressRequest $request,$id): Response
    {
        $model = $this->orderAddressRepository->findOrderAddress($id);
        return $this->response()
            ->setData($this->orderAddressRepository->deleteOrderAddress($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findOrderAddress(ViewOrderAddressRequest $request, $id): Response
    {
        $model = $this->orderAddressRepository->findOrderAddress($id);
        $data = OrderAddressDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
