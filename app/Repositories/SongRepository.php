<?php

namespace App\Repositories;

use App\Models\Song;
use App\Service\HelperService;

class SongRepository extends AbstractRepository
{

    private $helperService;

    public function __construct(HelperService $helperService)
    {
        $this->helperService = $helperService;
    }

    public function getModelClass(): string
    {
        return Song::class;
    }

    public function getOneByPath($path)
    {
        return $this->getOneById($this->helperService->getFileHash($path));
    }
}
