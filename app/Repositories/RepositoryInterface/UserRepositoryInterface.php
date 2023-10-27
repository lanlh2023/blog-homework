<?php
namespace App\Repositories\RepositoryInterface;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface 
{

     /**
     * Get user list by email
     * 
     * @param string email
     * @return @mixed $result
     */
    public function getByEmail(string $email); 
}
