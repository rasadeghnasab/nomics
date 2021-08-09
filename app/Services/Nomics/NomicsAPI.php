<?php

namespace App\Services\Nomics;

use App\Services\Nomics\Interfaces\UrlableInterface;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NomicsAPI
{
    private UrlableInterface $url;

    public function __construct(UrlableInterface $url)
    {
        $this->url = $url;
    }

    public function allCurrencies(array $data): Collection
    {
        $path = 'currencies';

        return Cache::remember(
            'nomics-currencies',
            24 * 60 * 60,
            function () use ($path, $data): Collection {
                return $this->get($path, $data);
            }
        );
    }

    public function currencyDetail($data): Collection
    {
        return $this->get('currencies/ticker', $data);
    }

    private function get($path, $data = []): Collection
    {
        $fulLUrl = $this->url->make($path, $data);

        $message = 'Something went wrong, please try again later.';
        try {
            $response = Http::get($fulLUrl);

            return $response->throw()->collect();
        } catch (RequestException $exception) {
            abort(400, $message);
        } catch (Exception $exception) {
            abort(500, $message);
        }
    }
}
