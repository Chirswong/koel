<?php

namespace App\Repositories;

use App\Models\Interaction;
use App\Models\User;
use App\Repositories\Traits\ByCurrentUser;

class InteractionRepository extends AbstractRepository
{

    use ByCurrentUser;
    public function getModelClass(): string
    {
        return Interaction::class;
    }

    /**
     * Get all songs favorite by a user
     * @param User $user
     */
    public function getUserFavorites(User $user)
    {
        return $this->model->where([
            'user_id' => $user->id,
            'liked' => true,
        ])
            ->with('song')
            ->get()
            ->pluck('song');
    }
}
