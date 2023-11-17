<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

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

      /**
     * Set role for user
     *
     * @param string userId
     * @param string roleId
     *
     * @return @mixed $result
     */
    public function setRole(string $userId, string $roleId) {
        try {
            DB::beginTransaction();
            $user = $this->getById($userId);
            if ($user) {
                $user->roles()->sync($roleId);
                if ($user->roles()->count()) {
                    DB::commit();
                    return true;
                }

                throw new Exception(Lang::get('notification-message.SET_ROLE_ERROR'));
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }

    }
}
