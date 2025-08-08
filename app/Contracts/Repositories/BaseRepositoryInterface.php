<?php

namespace App\Contracts\Repositories;

interface BaseRepositoryInterface
{
    public function store(array $payload);
    public function update(array $payload, $id);
    public function delete($id);
    public function show($id);
    public function index();
    public function data();
    public function findUser(int $id);
    public function insert(array $data);
}
