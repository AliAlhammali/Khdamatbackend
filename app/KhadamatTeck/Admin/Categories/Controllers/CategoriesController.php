<?php
namespace App\KhadamatTeck\Admin\Categories\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\Categories\Requests\CreateCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\DeleteCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\ListCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\UpdateCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Requests\ViewCategoryRequest;
use App\KhadamatTeck\Admin\Categories\Services\CategoriesService;

class CategoriesController extends Controller
{
    /**
     * @var CategoriesService $categoriesService
     */
    private CategoriesService $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function index(ListCategoryRequest $request)
    {
        return $this->categoriesService->paginateCategories($request);
    }

    public function create(CreateCategoryRequest $request)
    {
        return $this->categoriesService->createCategory($request);
    }


    public function show(ViewCategoryRequest $request, string $id): Response
    {
        return $this->categoriesService->findCategory($request, $id);
    }

    public function update(UpdateCategoryRequest $request,string $id)
    {
        return $this->categoriesService->updateCategory($request,$id);
    }

    public function delete(DeleteCategoryRequest $request,string $id)
    {
        return $this->categoriesService->deleteCategory($request,$id);
    }
}
