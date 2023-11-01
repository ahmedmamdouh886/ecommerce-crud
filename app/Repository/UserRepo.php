<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Abstract\AbstractRepo;

class UserRepo extends AbstractRepo 
{   
    /**
     * Class initialization.
     * 
     * @var \App\Models\User
     */
    public function __construct(User $userInstance) {
        parent::__construct($userInstance);
    }

    /**
     * Find model instance by username.
     * 
     * @param string $username
     * 
     * @return \App\Models\User
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findByUsername(string $username): User {
        return $this->model->where('username', $username)->firstOrFail();
    }
}
