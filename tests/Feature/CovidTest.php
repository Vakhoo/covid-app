<?php

namespace Tests\Feature;

use App\Models\CovidData;
use App\Models\User;
use Tests\TestCase;

class CovidTest extends TestCase
{
    /** @test */
    public function it_returns_all_covid()
    {
        $covidData = CovidData::factory()->count(5)->create();

        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $token = $user->createToken('test-token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        // Make API requests with the authenticated user
        $response = $this->withHeaders($headers)->get('/api/ka/covid');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        foreach ($covidData as $covid) {
            $response->assertJsonFragment([
                'country_id' => $covid->country_id,
                'confirmed' => $covid->confirmed,
                'recovered' => $covid->recovered,
                'critical' => $covid->critical,
                'deaths' => $covid->deaths
            ]);
        }
    }
}
