<?php

namespace App\Service;

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
            'albums'
        ];
    }
}
