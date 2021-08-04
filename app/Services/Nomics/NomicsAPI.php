<?php

namespace App\Services\Nomics;

use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NomicsAPI
{
    private string $key;

    public function __construct()
    {
        $this->key = config('nomics.key');
    }

    public function allCurrencies(): Collection
    {
        $url = 'currencies';

        return Cache::remember(
            'nomics-currencies',
            24 * 60 * 60,
            function () use ($url): Collection {
                return $this->get($url);
            }
        );
    }

    public function currenciesTicker($data): Collection
    {
        return $this->get('currencies/ticker', $data);
    }

    private function makeUrl(string $url, array $parameters = []): string
    {
        $trimValues = '\t\n\r\0\x0B\/';

        $apiUrl = rtrim(config('nomics.api_url'), $trimValues);
        $url = ltrim($url, $trimValues);
        $parameters['key'] = $parameters['key'] ?? $this->key;

        $query_parameters = http_build_query($parameters);

        return sprintf('%s/%s?%s', $apiUrl, $url, $query_parameters);
    }

    private function get($url, $data = []): Collection
    {
        $url = $this->makeUrl($url, $data);

        $message = 'Something went wrong, please try again later.';
        try {
            $response = Http::get($url);

            return $response->throw()->collect();
        } catch (RequestException $exception) {
            abort(400, $message);
        } catch (Exception $exception) {
            abort(500, $message);
        }
    }
}
