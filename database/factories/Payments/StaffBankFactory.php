<?php

namespace Database\Factories\Payments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\StaffBank>
 */
class StaffBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_name' => $this->faker->randomElement(["UBA","First Bank", "KUDA", "GTB"]),
            'account_number' => str_pad(rand(5894993,483679463), 11, '9', STR_PAD_BOTH),
            'account_name' => $this->faker->firstName() ." ". $this->faker->lastName(),
            'staff' => 1,
        ];
    }
}
