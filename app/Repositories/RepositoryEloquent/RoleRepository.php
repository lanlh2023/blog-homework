<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * Get model by classes that inherit it
     *
     * @return model
     */
    public function getModel()
    {
        return Role::class;
    }
}
