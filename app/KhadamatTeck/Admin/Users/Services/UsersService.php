<?php
namespace App\KhadamatTeck\Admin\Users\Services;

use App\KhadamatTeck\Admin\Users\Mappers\UserDTOMapper;
use App\KhadamatTeck\Admin\Users\Repositories\UsersRepository;
use App\KhadamatTeck\Admin\Users\Requests\CreateUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\DeleteUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\ListUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\UpdateUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\ViewUserRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class UsersService extends Service
{
    /**
     * @var UsersRepository $usersRepository
     * AE
     */
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
    parent::__construct($usersRepository);
        $this->usersRepository = $usersRepository;
    }

    public function paginateUsers(ListUserRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->usersRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->usersRepository->paginateUsers(
                $request->query(),
                $request->query('perPage')
            );
            $data = UserDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createUser(CreateUserRequest $request): Response
    {
        $data  =$this->usersRepository->createUser($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateUser(UpdateUserRequest $request,$id): Response
    {
        $model = $this->usersRepository->findUser($id);
        $data = $this->usersRepository->updateUser(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteUser(DeleteUserRequest $request,$id): Response
    {
        $model = $this->usersRepository->findUser($id);
        return $this->response()
            ->setData($this->usersRepository->deleteUser($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findUser(ViewUserRequest $request, $id): Response
    {
        $model = $this->usersRepository->findUser($id);
        $data = UserDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
