<?php

namespace Database\Factories\Payments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\StaffWallet>
 */
class StaffWalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff' => 1,
            'balance' => rand(1200, 3000),
            'threshold' => rand(200,990),
            'status' => 1,
        ];
    }
}
