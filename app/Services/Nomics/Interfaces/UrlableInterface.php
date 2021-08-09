<?php

namespace App\Services\Nomics\Interfaces;

interface UrlableInterface
{
    public function setBaseUrl(string $url): self;

    public function setApiKey(string $apiKey): self;

    public function make(string $path, array $queryParameters = []): string;
}
