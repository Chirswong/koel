<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $model;

    protected $auth;

    abstract public function getModelClass(): string;

    public function __construct()
    {
        // 获取模型
        $this->model = app($this->getModelClass());

        try {
            // 添加看守器
            $this->auth = app(Guard::class);
        } catch (\Exception $exception) {

        }
    }

    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    public function getAll(): Collection
    {
        return  $this->model->all();
    }

    public function getFirstWhere(...$params)
    {
        return  $this->model->where(...$params)->first();
    }
}
