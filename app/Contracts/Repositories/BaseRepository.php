<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(array $payload)
    {
        return $this->model->create($payload);
    }

    public function update(array $payload, $id)
    {
        $model  = $this->model->find($id);
        $result = $model->update($payload);
        if ($result) {
            $model->refresh();
            return $model;
        }

        return false;
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function index()
    {
        return $this->model->all();
    }

    public function data()
    {
        return $this->model->get();
    }

    public function findUser(int $id)
    {
        return $this->model->find($id);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }
}
