<?php

namespace App\Contracts\Repositories\Interface;

use App\Contracts\Repositories\BaseRepositoryInterface;

interface IAuthRepository extends BaseRepositoryInterface
{
    public function login(array $payload);
    public function register(array $payload);
    public function forgotPassword(array $payload);
}
