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

     /**
     * Get user list by email
     *
     * @param string email
     * @return @mixed $result
     */
    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
