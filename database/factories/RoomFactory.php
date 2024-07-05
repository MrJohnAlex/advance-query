<?php

namespace Database\Factories;
    
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => rtrim(ucfirst($this->faker->text(20)), '.'),
            'description' => $this->faker->sentence(),
            'hotel_id' => mt_rand(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-10 days', '-5 days'),
            'updated_at' => $this->faker->dateTimeBetween('-3 days', '-1 hour'),
            'room_type_id' => $this->faker->numberBetween(1,10)
        ];
    }
}