<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model by classes that inherit it
     *
     * @return void
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Soft delete entity
     *
     * @param  mixed  $entity,
     * @return true|false
     */
    public function delete($entity)
    {
        try {
            $entity->update([
                'deleted_date' => Carbon::now(),
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }

        return false;
    }

    /**
     * Find data in databse by ID
     *
     * @param  string|int  $id,
     * @return colection|false
     */
    public function getById($id, $isActive = null)
    {
        try {
            $result = $this->model->find($id);

            if ($isActive && $result->deleted_date != null) {
                return false;
            }

            if ($result) {
                return $result;
            }
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return false;
        }

        return false;
    }

    /**
     * Save record in table by array data
     *
     * @param  mixed  $entity,
     * @param  array  $data,
     * @return mixed|false
     */
    public function save($entity, $data)
    {
        $primaryKey = $this->model->getKeyName();
        try {
            if (isset($entity[$primaryKey])) {
                return $entity->update($data);
            }

            return $this->model->create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Save records in table by array data
     *
     * @param  array  $data
     * @return string|false
     */
    public function saveMany($data)
    {
        return false;
    }

    /**
     * Get all
     *
     * @return mixed
     */
    public function getAll($limit = 10, $isActive = true, $relationships = [])
    {
        try {
            $query = $this->model->when($isActive, function ($query) {
                return $query->active();
            })->when(! empty($relationships), function ($query) use ($relationships) {
                return $query->with($relationships);
            });

            return empty($limit) ? $query->get() : $query->paginate($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return [];
    }

    /**
     * Create new record in table by array data
     *
     * @param  array  $data,
     * @return mixed|false
     */
    public function create($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Soft destroy entity by id
     *
     * @param  string  $id,
     * @return true|false
     */
    public function destroy($id)
    {
        $primaryKey = $this->model->getKeyName();
        try {
            $this->model->where($primaryKey, $id)
                ->update(['deleted_date' => Carbon::now()]);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update record in table by array data
     *
     * @param  array  $data,
     * @return mixed|false
     */
    public function update(string $id, array $data)
    {
        try {
            return $this->model->find($id)->update($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
