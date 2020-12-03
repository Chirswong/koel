<?php

namespace App\Service;

interface ApiConsumerInterface
{
    public function getEndPoint(): ?string;

    public function getKey(): ?string;

    public function getSecret(): ?string;
}
