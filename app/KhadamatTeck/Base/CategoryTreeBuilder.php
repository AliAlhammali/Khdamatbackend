<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Support\Collection;
use App\KhadamatTeck\Categories\Models\Category;

class CategoryTreeBuilder
{

    private Collection $items;
    private string $parentKey; // category_id
    private string $categoryParentKey = "parent_id";

    public function __construct(Collection $items, string $parentKey)
    {
        $this->items = $items;
        $this->parentKey = $parentKey;
    }

    private function parentQuery()
    {
        return Category::select('id', "owner_type", "parent_id", "name", "slug", "icon");
    }

    public function ancestorsAndSelf(): array
    {
        // get all categories by items
        $categories = $this->parentQuery()->whereIn("id", $this->items->pluck($this->parentKey))->get()->toArray();
        // add items to category
        foreach ($categories as &$category) {
            $items = [];
            foreach ($this->items as $item) {
                if ($item[$this->parentKey] == $category['id']) $items[] = $item;
            }
            $category['items'] = $items;
        }
        return $this->mergeChildrenIfParentExist($this->getCategoryParent($categories));
    }


    private function getCategoryParent($categories)
    {
        $mainCategories = [];
        $parentCategoryIds = [];
        foreach ($categories as $category) {
            if ($category[$this->categoryParentKey] == null)
                $mainCategories[] = $category;
            else
                $parentCategoryIds[] = $category[$this->categoryParentKey];
        }
        if (count($parentCategoryIds) > 0) {
            $parentCategories = $this->parentQuery()->whereIn("id", $parentCategoryIds)->get()->toArray();
            foreach ($parentCategories as &$pCategory) {
                $items = [];
                foreach ($categories as $category)
                    if ($category[$this->categoryParentKey] == $pCategory['id']) {
                        if (!isset($category['children'])) {
                            $category['children'] = [];
                        }
                        if (!isset($category['items'])) {
                            $category['items'] = [];
                        }
                        $items[] = $category;
                    }

                $pCategory['children'] = $items;
                $mainCategories[] = $pCategory;
            }

            return $this->getCategoryParent($mainCategories);
        }
        return $categories;
    }

    private function mergeChildrenIfParentExist($mainCategories): array
    {
        foreach ($mainCategories as &$mainCategory) {
            $mainChildren = $mainCategory['children'] ?? [];
            foreach ($mainCategories as &$secondCategory) {
                if ($mainCategory['id'] == $secondCategory['id']) {
                    foreach ($secondCategory['children'] ?? [] as &$child) {
                        $isExist = false;
                        foreach ($mainChildren as $mainChild) {
                            if ($mainChild["id"] == $child['id']) {
                                $isExist = true;
                                break;
                            }

                        }
                        if (!$isExist) {
                            if (!isset($child['children'])) {
                                $child['children'] = [];
                            }
                            $mainChildren[] = $child;
                        }
                    }

                    $mainCategory['children'] = $mainChildren;
                }
            }
        }

        $finalCategories = [];
        foreach ($mainCategories as &$mainCategory) {
            foreach ($finalCategories as &$secondCategory)
                if ($secondCategory['id'] == $mainCategory['id'])
                    continue 2;
            if (!isset($mainChildren['children'])) {
                $mainChildren['children'] = [];
            }
            $finalCategories[] = $mainCategory;
        }
        return $finalCategories;
    }
}
