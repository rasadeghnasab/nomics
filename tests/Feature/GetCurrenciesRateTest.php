<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class GetCurrenciesRateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
    }

    /**
     * @return void
     */
    public function test_ids_is_required(): void
    {
        $parameters = [
            'per-page' => 1
        ];

        $response = $this->json('get', route('nomics.currencies.rate', $parameters));

        $response->assertJsonValidationErrors(['ids']);
    }

    /**
     * @return void
     */
    public function test_per_page_should_be_numeric(): void
    {
        $parameters['per-page'] = 'non-numeric';

        $response = $this->json('get', route('nomics.currencies.rate', $parameters));
        $response->assertJsonValidationErrors(['per-page']);
    }

    public function test_page_page_should_be_greater_than_zero()
    {
        $parameters['per-page'] = '0';

        $response = $this->json('get', route('nomics.currencies.rate', $parameters));
        $response->assertJsonValidationErrors(['per-page']);
    }

    /**
     * @return void
     */
    public function test_per_page_is_optional(): void
    {
        $parameters = ['ids' => 'BTC'];
        $response = $this->json('get', route('nomics.currencies.rate', $parameters));
        $response->assertJsonMissingValidationErrors(['per-page']);

        $parameters = ['ids' => 'BTC', 'per-page' => 1];
        $response = $this->json('get', route('nomics.currencies.rate', $parameters));
        $response->assertJsonMissingValidationErrors(['per-page']);
    }
}