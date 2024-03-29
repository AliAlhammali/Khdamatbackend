<?php

namespace App\KhadamatTeck\Admin\Categories\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\KhadamatTeck\Base\Repository;
use App\KhadamatTeck\Admin\Categories\Mappers\CategoryDTOMapper;
use App\KhadamatTeck\Admin\Categories\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;

class CategoriesRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Category());
    }

    public function findAll(): array|Collection
    {
        return Category::query()->get();
    }

    public function paginateCategories($requestQuery, $perPage = 20): LengthAwarePaginator
    {
        return QueryBuilder::for(Category::class)
            ->allowedFilters(Category::getAllowedFilters())
            ->paginate($perPage)
            ->appends($requestQuery);
    }

    public function findCategory(string $id)
    {
        return Category::findOrFail($id);
    }

    public function createCategory(array $data)
    {
        return CategoryDTOMapper::fromModel(Category::create($data));
    }

    public function updateCategory($model, array $data)
    {
        $model->fill($data)->save();
        return CategoryDTOMapper::fromModel($model);
    }

    public function deleteCategory($model)
    {
        $model->delete();
        return CategoryDTOMapper::fromModel($model);
    }

    public function getMinimalList()
    {
        return Category::listing()->get();
    }
}
