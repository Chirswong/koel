<?php

namespace App\Service;

class iTunesService extends AbstractApiClient implements ApiConsumerInterface
{
    public function used()
    {
        return (bool)config('koel.itunes.enable');
    }

    public function getKey(): ?string
    {
        // TODO: Implement getKey() method.
    }

    public function getSecret(): ?string
    {
        // TODO: Implement getSecret() method.
    }

    public function getEndpoint(): ?string
    {
        // TODO: Implement getEndpoint() method.
    }
}
