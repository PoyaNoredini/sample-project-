<?php

namespace App\Contracts\Repositories\Auth;

use App\Contracts\Repositories\BaseRepository;
use App\Models\User;
use App\Contracts\Repositories\Interface\IAuthRepository;

class AuthRepository extends BaseRepository implements IAuthRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(array $payload)
    {
        return $this->model->where('user_name', $payload['user_name'])->first();
    }

    public function register(array $payload)
    {
        return $this->model->create($payload);
    }

    public function forgotPassword(array $payload)
    {
        return $this->model->where('user_name', $payload['user_name'])->orWhere('phone_number', $payload['phone_number'])->first();
    }
}
