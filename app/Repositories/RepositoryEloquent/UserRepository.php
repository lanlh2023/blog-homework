<?php
namespace App\Repositories\RepositoryEloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;

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
     * Get all
     * @return mixed
     */
    public function getAll() {
        try {
            return $this->model->all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        
        return [];
    }
}
