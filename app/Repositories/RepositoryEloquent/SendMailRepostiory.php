<?php

namespace App\Repositories\RepositoryEloquent;

use App\Models\SendMail;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\SendMailRepositoryInterface;
use Illuminate\Support\Facades\Log;

class SendMailRepostiory extends BaseRepository implements SendMailRepositoryInterface
{
    /**
     * Get model by classes that inherit it
     *
     * @return model
     */
    public function getModel()
    {
        return SendMail::class;
    }

    /**
     * Get all with key_send
     *
     * @param  array  $columns
     * @param  bool  $isKeySendZero
     * @return mixed
     */
    public function getAllWithKeySend($columns = ['*'], $isKeySendZero = true)
    {
        try {
            return $this->model->when($isKeySendZero, function ($query) {
                return $query->keySendZero();
            })->select(...$columns)->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return [];
    }
}
