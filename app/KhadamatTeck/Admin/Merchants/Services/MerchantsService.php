<?php
namespace App\KhadamatTeck\Admin\Merchants\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Admin\Merchants\Repositories\MerchantsRepository;
use App\KhadamatTeck\Admin\Merchants\Requests\CreateMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\DeleteMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\ListMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\UpdateMerchantRequest;
use App\KhadamatTeck\Admin\Merchants\Requests\ViewMerchantRequest;
use App\KhadamatTeck\Merchant\Merchants\Mappers\MerchantDTOMapper;

class MerchantsService extends Service
{
    /**
     * @var MerchantsRepository $merchantsRepository
     * AE
     */
    private MerchantsRepository $merchantsRepository;

    public function __construct(MerchantsRepository $merchantsRepository)
    {
    parent::__construct($merchantsRepository);
        $this->merchantsRepository = $merchantsRepository;
    }

    public function paginateMerchants(ListMerchantRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->merchantsRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->merchantsRepository->paginateMerchants(
                $request->query(),
                $request->query('perPage')
            );
            $data = MerchantDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createMerchant(CreateMerchantRequest $request): Response
    {
        $data  =$this->merchantsRepository->createMerchant($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateMerchant(UpdateMerchantRequest $request,$id): Response
    {
        $model = $this->merchantsRepository->findMerchant($id);
        $data = $this->merchantsRepository->updateMerchant(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteMerchant(DeleteMerchantRequest $request,$id): Response
    {
        $model = $this->merchantsRepository->findMerchant($id);
        return $this->response()
            ->setData($this->merchantsRepository->deleteMerchant($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findMerchant(ViewMerchantRequest $request, $id): Response
    {
        $model = $this->merchantsRepository->findMerchant($id);
        $data = MerchantDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
