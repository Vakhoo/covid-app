<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CovidDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country = Country::factory()->create();

        return [
            'country_id' => $country->id,
            'confirmed' => $this->faker->randomNumber(),
            'recovered' => $this->faker->randomNumber(),
            'critical' => $this->faker->randomNumber(),
            'deaths' => $this->faker->randomNumber(),
        ];
    }
}
