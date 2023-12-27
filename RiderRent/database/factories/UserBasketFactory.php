<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserBasket>
 */
class UserBasketFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'user_id' => \App\Models\User::factory(),
            'moto_id' => \App\Models\Moto::factory(),
            'quantity' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement(['pendingTransaction', 'paymentFinished', 'removedWithoutFinish']),
        ];
    }
}
