<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetAllCurrenciesTest extends TestCase
{
    protected array $currencies;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        // Mock nomics endpoints
        $nomicsAllCurrenciesPath = sprintf('%s%s*', config('nomics.api_url'), 'currencies');

        $this->currencies = [
            [
                'id' => 'the-currency-id',
                'name' => 'the-currency-name',
            ],
            [
                'id' => 'the-currency-id-2',
                'name' => 'the-currency-name-2',
            ]
        ];

        Http::fake([
            $nomicsAllCurrenciesPath => Http::response($this->currencies),
        ]);
    }

    public function test_should_return_all_the_existing_currencies(): void
    {
        $response = $this->json('get', route('nomics.currencies'));

        $response->assertJson($this->currencies);
    }

    public function test_content_should_be_cached_after_first_call(): void
    {
        $key = 'nomics-currencies';

        $this->assertEmpty(Cache::get($key));

        $this->json('get', route('nomics.currencies'));

        $this->assertNotEmpty(Cache::get($key));
    }
}
