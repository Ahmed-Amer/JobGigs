<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'tags' => 'laravel, javascript',
            'company' => fake()->company(),
            'location' => fake()->city(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'description' =>fake()->paragraph(3),
        ];
    }
}
