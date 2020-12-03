<?php
namespace App\Repositories;

use App\Models\Playlist;
use App\Repositories\Traits\ByCurrentUser;

class PlaylistRepository extends AbstractRepository
{

    use ByCurrentUser;

    public function getModelClass(): string
    {
        return Playlist::class;
    }

    public function getAllByCurrentUser()
    {
        return $this->byCurrentUser()->orderBy('name')->get();
    }
}
