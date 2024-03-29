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
    public function getModel()
    {
        return User::class;
    }

    /**
     * Get user list by email
     *
     * @param string email
     * @return @mixed $result
     */
    public function getByEmail(string $email, ?string $id = null)
    {
        return $this->model->when($id, function ($query, $id) {
            return $query->whereNotIn('id', [$id]);
        })->where('email', $email)->first();
    }

    /**
     * Search by conditions
     *
     * @param  array  $orderColumns
     * @return mixed
     */
    public function getByConditions(array $conditions, $limit = 10, $isActive = true, $relationships = [], $orderColumns = [])
    {
        try {
            $query = $this->model;
            if (! empty($conditions['name'])) {
                $query = $query->searchByName($conditions['name']);
            }

            if (! empty($conditions['role_id'])) {
                $query = $query->searchByRole($conditions['role_id']);
            }

            $query = $query->when($isActive, function ($query) {
                return $query->active();
            })->when(! empty($relationships), function ($query) use ($relationships) {
                return $query->with($relationships);
            });

            foreach ($orderColumns as $coluums => $sortDirection) {
                $query = $query->orderBy($coluums, $sortDirection);
            }

            return empty($limit) ? $query->get() : $query->paginate($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [];
        }
    }
}
