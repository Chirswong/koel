<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return User::class;
    }

    public function getOneById($id): ?Model
    {
        // TODO: Implement getOneById() method.
    }

    public function getByIds(array $ids): Collection
    {
        // TODO: Implement getByIds() method.
    }

    public function getAll(): Collection
    {
        // TODO: Implement getAll() method.
    }
}
