<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'user_id' => \App\Models\User::factory(),
            'moto_id' => \App\Models\Moto::factory(),
            'discount_id' => \App\Models\Discount::factory(),
            'start_date' => $this->faker->dateTimeThisMonth(),
            'requested_end_date' => $this->faker->dateTimeThisMonth(),
            'actual_end_date' => $this->faker->optional(0.7)->dateTimeThisMonth(),
            'total_requested_price' => $this->faker->randomFloat(2, 0, 1000),
            'total_actual_price' => $this->faker->randomFloat(2, 0, 1000),
            'is_active' => $this->faker->boolean,
        ];
    }
}
