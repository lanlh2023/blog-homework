<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Get model by classes that inherit it
     *
     * @return model
     */
    public function getModel()
    {
        return Category::class;
    }
}
