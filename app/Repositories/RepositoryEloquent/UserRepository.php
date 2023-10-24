<?php
namespace App\Repositories\RepositoryEloquent;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel() {
        return User::class;
    }
}
