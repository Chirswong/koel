<?php

namespace App\Service;

class LastfmService extends AbstractApiClient implements ApiConsumerInterface
{

    protected $KeyParam = 'api_key';

    public function used()
    {
        return (bool) $this->getKey();
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
