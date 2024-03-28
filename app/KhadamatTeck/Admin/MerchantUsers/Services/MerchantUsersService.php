<?php
namespace App\KhadamatTeck\Admin\MerchantUsers\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Admin\MerchantUsers\Repositories\MerchantUsersRepository;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\CreateMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\DeleteMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\ListMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\UpdateMerchantUserRequest;
use App\KhadamatTeck\Admin\MerchantUsers\Requests\ViewMerchantUserRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Mappers\MerchantUserDTOMapper;

class MerchantUsersService extends Service
{
    /**
     * @var MerchantUsersRepository $merchantUsersRepository
     * AE
     */
    private MerchantUsersRepository $merchantUsersRepository;

    public function __construct(MerchantUsersRepository $merchantUsersRepository)
    {
    parent::__construct($merchantUsersRepository);
        $this->merchantUsersRepository = $merchantUsersRepository;
    }

    public function paginateMerchantUsers(ListMerchantUserRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->merchantUsersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->merchantUsersRepository->paginateMerchantUsers(
                $request->query(),
                $request->query('perPage')
            );
            $data = MerchantUserDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createMerchantUser(CreateMerchantUserRequest $request): Response
    {
        $data  =$this->merchantUsersRepository->createMerchantUser($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateMerchantUser(UpdateMerchantUserRequest $request,$id): Response
    {
        $model = $this->merchantUsersRepository->findMerchantUser($id);
        $data = $this->merchantUsersRepository->updateMerchantUser(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteMerchantUser(DeleteMerchantUserRequest $request,$id): Response
    {
        $model = $this->merchantUsersRepository->findMerchantUser($id);
        return $this->response()
            ->setData($this->merchantUsersRepository->deleteMerchantUser($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findMerchantUser(ViewMerchantUserRequest $request, $id): Response
    {
        $model = $this->merchantUsersRepository->findMerchantUser($id);
        $data = MerchantUserDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
