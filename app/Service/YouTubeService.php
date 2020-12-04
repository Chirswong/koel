<?php

namespace App\Service;

class YouTubeService extends AbstractApiClient implements ApiConsumerInterface
{

    public function enabled()
    {
        return (bool) $this->getKey();
    }
    public function getKey(): ?string
    {
        return config('koel.youtube.key');
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
