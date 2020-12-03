<?php

namespace App\Service;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Cache\Repository as Cache;

class MediaCacheService
{
    private const CACHE_KEY = 'media_cache';

    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function get(): array
    {
        if (!config('koel.cache_media')) {
            return $this->query();
        }
        return $this->cache->rememberForever(self::CACHE_KEY, function (): array {
            return $this->query();
        });
    }

    private function query(): array
    {
        return [
            'albums' => Album::query()->orderBy('name')->get(),
            'artists' => Artist::query()->orderBy('name')->get(),
            'songs' => Song::all()
        ];
    }

    public function clear(): void
    {
        $this->cache->forget(self::CACHE_KEY);
    }
}
