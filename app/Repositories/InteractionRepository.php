<?php

namespace App\Repositories;

use App\Repositories\Traits\ByCurrentUser;

class InteractionRepository extends AbstractRepository
{

    use ByCurrentUser;
    public function getModelClass(): string
    {
        // TODO: Implement getModelClass() method.
    }
}
