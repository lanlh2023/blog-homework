<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Support\Facades\Log;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * Get model by classes that inherit it
     *
     * @return model
     */
    public function getModel()
    {
        return Post::class;
    }
    /**
     * Search by conditions
     * @param array $conditions
     * @param $limit
     * @param $isActive
     * @param $relationships
     * @param array $orderColumns
     * @return mixed
     */
    public function getByConditions(array $conditions, $limit = 10, $isActive = true, $relationships = [], $orderColumns = [])
    {
        try {
            $query = $this->model;
            if (!empty($conditions['content_search'])) {
                $query = $query->searchByContentTitle($conditions['content_search'])
                    ->searchByTitle($conditions['content_search']);
            }

            if (!empty($conditions['user_name_search'])) {
                $query = $query->searchByUserName($conditions['user_name_search']);
            }

            $query =  $query->when($isActive, function ($query) {
                return $query->active();
            })->when(!empty($relationships), function ($query) use ($relationships) {
                return $query->with($relationships);
            });

            foreach($orderColumns as $coluums => $sortDirection) {
                $query = $query->orderBy($coluums, $sortDirection);
            }

            return empty($limit) ? $query->get() : $query->paginate($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}
