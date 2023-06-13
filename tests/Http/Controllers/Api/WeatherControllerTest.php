<?php

namespace Tests\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class WeatherControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_see_list_of_forecast_data()
    {
        $data = file_get_contents(base_path('tests/Fixtures/Helpers/kyoto.json'));

        Http::fake([
            config('open-weather.base_url') . '/*' => Http::response($data, 200)
        ]);

        $this->json('post', '/api/v1/forecast', [
            'city' => 'kyoto'
        ])
            ->assertOk()
            ->assertJson(fn(AssertableJson $list) =>
            $list->has('list', 40)
                ->has('list.0', fn(AssertableJson $data) =>
                $data->has('weather')
                    ->has('weather.0', fn(AssertableJson $weather) =>
                    $weather
                        ->where('id', 804)
                        ->where('main', 'Clouds')
                    ->etc())->etc())->etc());
    }

    /** @test */
    public function it_cannot_process_forecast_if_no_city()
    {
        $response = $this->json('post', '/api/v1/forecast', [
            'city' => ''
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function it_cannot_process_forecast_if_exceed_city_character_length()
    {
        $response = $this->json('post', '/api/v1/forecast', [
            'city' => str_repeat('a', 256)
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function it_cannot_process_forecast_if_city_not_string()
    {
        $response = $this->json('post', '/api/v1/forecast', [
            'city' => 1
        ]);

        $response->assertStatus(422);
    }
}
