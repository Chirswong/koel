<?php

namespace App\Service;

use App\Application;
use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Log\Logger;

class ApplicationInformationService
{
    private const CACHE_KEY = 'latestKoelVersion';

    private $client;
    private $cache;
    private $logger;

    public function __construct(Client $client, Cache $cache, Logger $logger)
    {
        $this->cache = $cache;
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getLatestVersionNumber()
    {
        return $this->cache->remember(self::CACHE_KEY,1*24*60,function (){
            try {
                return json_decode(
                    $this->client->get('https://api.github.com/repos/phanan/koel/tags')->getBody()
                )[0]->name;
            }catch (\Exception $exception){
                $this->logger->error($exception);
                return  Application::KOEK_VERSION;
            }
        });
    }
}
