<?php

namespace App\KhadamatTeck\Admin\Users\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\Users\Requests\CreateUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\DeleteUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\ListUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\UpdateUserRequest;
use App\KhadamatTeck\Admin\Users\Requests\ViewUserRequest;
use App\KhadamatTeck\Admin\Users\Services\UsersService;
use App\KhadamatTeck\Base\Response;

class UsersController extends Controller
{
    /**
     * @var UsersService $usersService
     */
    private UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(ListUserRequest $request)
    {
        return $this->usersService->paginateUsers($request);
    }

    public function create(CreateUserRequest $request)
    {
        return $this->usersService->createUser($request);
    }


    public function show(ViewUserRequest $request, string $id): Response
    {
        return $this->usersService->findUser($request, $id);
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        return $this->usersService->updateUser($request, $id);
    }

    public function delete(DeleteUserRequest $request, string $id)
    {
        return $this->usersService->deleteUser($request, $id);
    }
}
