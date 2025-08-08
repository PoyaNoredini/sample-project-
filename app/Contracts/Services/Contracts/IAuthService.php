<?php

namespace App\Contracts\Services\Contracts;

interface IAuthService
{
    public function login(array $credentials);
    public function register(array $userData);
    public function forgotPassword(array $payload);
}
