<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beds'=>fake()->numberBetween(1,7),
            'baths'=>fake()->numberBetween(1,7),
            'area'=>fake()->numberBetween(30,400),
            'code'=>\fake()->postcode(),
            'city'=>fake()->city(),
            'street'=>fake()->streetAddress(),
            'street_nr'=>fake()->numberBetween(10,200),
            'price'=>fake()->numberBetween(50_000,2_000_000),
        ];
    }
}
