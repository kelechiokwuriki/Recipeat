<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function retrieveByOrder(string $column, string $order)
    {
        return $this->model->orderBy($column, $order);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function where(string $column, $value)
    {
        return $this->model->where($column, $value);
    }

    public function whereCompare(string $column, string $comparator, string $value)
    {
        return $this->model->where($column, $comparator, $value);
    }

    public function whereFirst(string $column, $value)
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function getByOrderAndNumber(string $column, string $orderType, int $number)
    {
        return $this->model->orderBy($column, $orderType)->take($number);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
