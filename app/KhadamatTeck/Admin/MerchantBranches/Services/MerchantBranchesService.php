<?php

namespace App\KhadamatTeck\Admin\MerchantBranches\Services;

use App\KhadamatTeck\Admin\MerchantBranches\Mappers\MerchantBranchDTOMapper;
use App\KhadamatTeck\Admin\MerchantBranches\Repositories\MerchantBranchesRepository;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\CreateMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\DeleteMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\ListMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\UpdateMerchantBranchRequest;
use App\KhadamatTeck\Admin\MerchantBranches\Requests\ViewMerchantBranchRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class MerchantBranchesService extends Service
{
    /**
     * @var MerchantBranchesRepository $merchantBranchesRepository
     * AE
     */
    private MerchantBranchesRepository $merchantBranchesRepository;

    public function __construct(MerchantBranchesRepository $merchantBranchesRepository)
    {
        parent::__construct($merchantBranchesRepository);
        $this->merchantBranchesRepository = $merchantBranchesRepository;
    }

    public function paginateMerchantBranches(ListMerchantBranchRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->merchantBranchesRepository->minimalListWithFilter(['id','name']);
            $response->setData($data);
        } else {
            $data = $this->merchantBranchesRepository->paginateMerchantBranches(
                $request->query(),
                $request->query('perPage')
            );
            $data = MerchantBranchDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createMerchantBranch(CreateMerchantBranchRequest $request): Response
    {
        $data = $this->merchantBranchesRepository->createMerchantBranch($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateMerchantBranch(UpdateMerchantBranchRequest $request, $id): Response
    {
        $model = $this->merchantBranchesRepository->findMerchantBranch($id);
        $data = $this->merchantBranchesRepository->updateMerchantBranch(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteMerchantBranch(DeleteMerchantBranchRequest $request, $id): Response
    {
        $model = $this->merchantBranchesRepository->findMerchantBranch($id);
        return $this->response()
            ->setData($this->merchantBranchesRepository->deleteMerchantBranch($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findMerchantBranch(ViewMerchantBranchRequest $request, $id): Response
    {
        $model = $this->merchantBranchesRepository->findMerchantBranch($id);
        $data = MerchantBranchDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
