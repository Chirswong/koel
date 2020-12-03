<?php

namespace App\Service;

class ApplicationInformationService
{
    private const CACHE_KEY = 'latestKoelVersion';

    private $client;
    private $cache;
    private $logger;

    public function __construct()
    {

    }
}
