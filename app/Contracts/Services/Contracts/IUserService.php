<?php

namespace App\Contracts\Services\Contracts;

interface IUserService
{
    public function index();
    public function show(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
