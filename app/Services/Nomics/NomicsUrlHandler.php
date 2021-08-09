<?php

namespace App\Services\Nomics;

use App\Services\Nomics\Interfaces\UrlableInterface;

class NomicsUrlHandler implements UrlableInterface
{
    private string $baseUrl;
    private string $apiKey;
    private string $trimValues = '\t\n\r\0\x0B\/';

    public function setApiKey(string $apiKey): UrlableInterface
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setBaseUrl(string $baseUrl): UrlableInterface
    {
        $this->baseUrl = rtrim($baseUrl, $this->trimValues);

        return $this;
    }

    public function make(string $path, array $queryParameters = []): string
    {
        $url = ltrim($path, $this->trimValues);

        $queryParameters['key'] = $queryParameters['key'] ?? $this->apiKey ?? '';

        $stringQueryParameters = http_build_query($queryParameters);

        return sprintf('%s/%s?%s', $this->baseUrl, $url, $stringQueryParameters);
    }
}
