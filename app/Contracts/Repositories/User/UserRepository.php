<?php

namespace App\Contracts\Repositories\User;

use App\Contracts\Repositories\Interface\IUserRepository;
use App\Contracts\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }



}
