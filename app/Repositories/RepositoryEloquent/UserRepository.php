<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
    * Get model by classes that inherit it
    *
    * @return model
    */
    public function getModel() {
        return User::class;
    }

    /**
     * Get user list by email
     *
     * @param string email
     * @return @mixed $result
     */
    public function getByEmail(string $email, string $id = null)
    {
        return $this->model->when($id, function ($query, $id) {
            return $query->whereNotIn('id', [$id]);
        })->where('email', $email)->first();
    }
}
