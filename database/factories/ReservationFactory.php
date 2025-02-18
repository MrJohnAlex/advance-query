<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'check_in' => $this->faker->dateTimeBetween('+2 days', '+5 days'),
            'check_out' => $this->faker->dateTimeBetween('+5 days', '+10 days'),
            'price' => $this->faker->numberBetween(100,500),
            'user_id' => $this->faker->numberBetween(1,10)  // Assuming User has a hasMany relationship with Reservation
        ];
    }
}