<?php

namespace App\KhadamatTeck\Admin\Categories\Services;

use App\KhadamatTeck\Admin\Categories\Mappers\CategoryDTOMapper;
use App\KhadamatTeck\Admin\Categories\Repositories\CategoriesRepository;
use App\KhadamatTeck\Admin\Categories\Requests\CreateCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\DeleteCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\ListCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\UpdateCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\ViewCategoryRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class CategoriesService extends Service
{
    /**
     * @var CategoriesRepository $categoriesRepository
     * AE
     */
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        parent::__construct($categoriesRepository);
        $this->categoriesRepository = $categoriesRepository;
    }

    public function paginateCategories(ListCategoryRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->categoriesRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->categoriesRepository->paginateCategories(
                $request->query(),
                $request->query('perPage')
            );
            $data = CategoryDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createCategory(CreateCategoryRequest $request): Response
    {
        $data = $this->categoriesRepository->createCategory($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateCategory(UpdateCategoryRequest $request, $id): Response
    {
        $model = $this->categoriesRepository->findCategory($id);
        $data = $this->categoriesRepository->updateCategory(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteCategory(DeleteCategoryRequest $request, $id): Response
    {
        $model = $this->categoriesRepository->findCategory($id);
        return $this->response()
            ->setData($this->categoriesRepository->deleteCategory($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findCategory(ViewCategoryRequest $request, $id): Response
    {
        $model = $this->categoriesRepository->findCategory($id);
        $data = CategoryDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
