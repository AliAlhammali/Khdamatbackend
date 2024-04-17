<?php

namespace App\KhadamatTeck\Admin\MerchantClients\Services;

use App\KhadamatTeck\Admin\MerchantClients\Mappers\MerchantClientDTOMapper;
use App\KhadamatTeck\Admin\MerchantClients\Repositories\MerchantClientsRepository;
use App\KhadamatTeck\Admin\MerchantClients\Requests\CreateMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\DeleteMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\ListMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\UpdateMerchantClientRequest;
use App\KhadamatTeck\Admin\MerchantClients\Requests\ViewMerchantClientRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class MerchantClientsService extends Service
{
    /**
     * @var MerchantClientsRepository $merchantClientsRepository
     * AE
     */
    private MerchantClientsRepository $merchantClientsRepository;

    public function __construct(MerchantClientsRepository $merchantClientsRepository)
    {
        parent::__construct($merchantClientsRepository);
        $this->merchantClientsRepository = $merchantClientsRepository;
    }

    public function paginateMerchantClients(ListMerchantClientRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->merchantClientsRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->merchantClientsRepository->paginateMerchantClients(
                $request->query(),
                $request->query('perPage')
            );
            $data = MerchantClientDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createMerchantClient(CreateMerchantClientRequest $request): Response
    {
        $data = $this->merchantClientsRepository->createMerchantClient($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateMerchantClient(UpdateMerchantClientRequest $request, $id): Response
    {
        $model = $this->merchantClientsRepository->findMerchantClient($id);
        $data = $this->merchantClientsRepository->updateMerchantClient(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteMerchantClient(DeleteMerchantClientRequest $request, $id): Response
    {
        $model = $this->merchantClientsRepository->findMerchantClient($id);
        return $this->response()
            ->setData($this->merchantClientsRepository->deleteMerchantClient($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findMerchantClient(ViewMerchantClientRequest $request, $id): Response
    {
        $model = $this->merchantClientsRepository->findMerchantClient($id);
        $data = MerchantClientDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
