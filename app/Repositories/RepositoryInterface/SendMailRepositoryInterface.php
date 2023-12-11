<?php
namespace App\Repositories\RepositoryInterface;

use App\Repositories\RepositoryInterface;

interface SendMailRepositoryInterface extends RepositoryInterface
{
     /**
     * Get all with key_send
     *
     * @param array $columns
     * @param boolean $isKeySendZero
     *
     * @return mixed
     */
    public function getAllWithKeySend($columns = ['*'], $isKeySendZero = true);
}
