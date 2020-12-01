<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getModelClass(): string;

    public function getOneById($id): ?Model;

    public function getByIds(array $ids): Collection;

    public function getAll(): Collection;
}
