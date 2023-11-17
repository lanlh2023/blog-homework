<?php
namespace App\Repositories\RepositoryInterface;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{

     /**
     * Get user list by email
     *
     * @param string email
     * @param string id
     *
     * @return @mixed $result
     */
    public function getByEmail(string $email, string $id = null);

       /**
     * Set role for user
     *
     * @param string userId
     * @param string roleId
     *
     * @return @mixed $result
     */
    public function setRole(string $userId, string $roleId);
}
