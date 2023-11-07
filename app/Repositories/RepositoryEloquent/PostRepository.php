<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;

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
}
