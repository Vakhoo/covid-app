<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $token = $user->createToken('test-token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        // Make API requests with the authenticated user
        $response = $this->withHeaders($headers)->get('/api/ka/country');


        $response->assertStatus(200);
    }

    use RefreshDatabase;

    /** @test */
    public function it_returns_all_countries()
    {
        $countries = Country::factory()->count(5)->create();

        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $token = $user->createToken('test-token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        // Make API requests with the authenticated user
        $response = $this->withHeaders($headers)->get('/api/ka/country');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        foreach ($countries as $country) {
            $response->assertJsonFragment(['code' => $country->code, 'name' => $country->getOriginal('name')]);
        }
    }
}
