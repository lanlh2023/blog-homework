<?php

namespace App\Repositories;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use App\Libs\ConfigUtil;

abstract class BaseRepository {
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
    * @param mixed $entity,
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
    * @param string|int $id,
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
    * @param mixed $entity,
    * @param array $data,
    * @return mixed|false
    */
    public function save($entity, $data) 
    {
        $primaryKey = $this->model->getKeyName();
        try {
            if(isset($entity[$primaryKey])) {
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
    * @param array $data 
    * @return string|false
    */
    public function saveMany($data) 
    {
        return false;
    }
}