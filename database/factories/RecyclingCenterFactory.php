<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecyclingCenter>
 */
class RecyclingCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $latitude = $this->faker->latitude;
        $longitude = $this->faker->longitude;

        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'opening_hours' => 'Mon-Fri: 9 AM - 5 PM',
            'contact_info' => $this->faker->phoneNumber,
            'website_url' => $this->faker->url,
            'location' => "https://www.google.com/maps?q={$latitude},{$longitude}", 
        ];
    }
}
