<?php

namespace Tests\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PlacesControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_see_list_of_venues()
    {
        $data = file_get_contents(base_path('tests/Fixtures/Helpers/venues.json'));

        Http::fake([
            config('places.foursquare_base_url') . '/*' => Http::response($data, 200)
        ]);

        $this->json('post', '/api/v1/venue-search', [
            'city' => 'kyoto'
        ])
            ->assertOk()
            ->assertJson(fn(AssertableJson $list) =>
            $list
                ->has('results', 10)
                ->has('results.0', fn(AssertableJson $data) =>
                $data->has('categories')
                    ->has('categories.0', fn(AssertableJson $category) =>
                    $category
                        ->where('id', 13020)
                        ->where('name', 'Sake Bar')
                        ->etc()
                    )->etc())->etc());
    }
}
