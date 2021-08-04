<?php

namespace App\Services\Nomics;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class NomicsAPI extends Facade
{
    private string $key;

    public function __construct()
    {
        $this->key = config('nomics.key');
    }

    public function allCurrencies(): array
    {
        $url = $this->makeUrl('currencies');

        $response = Http::get($url);

        dd($response);
    }

    private function makeUrl(string $url, array $parameters)
    {
        $trimValues = '\t\n\r\0\x0B\/';

        $apiUrl = rtrim(config('nomics.api_url'), $trimValues);
        $url = ltrim($url, $trimValues);
        $parameters['key'] = $parameters['key'] ?? $this->key;

        $query_parameters = http_build_query($parameters);

        return sprintf('%s/%s?%s', $apiUrl, $url, $query_parameters);
    }
}
