<?php

namespace Database\Factories\Payments;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\StaffWithdrawal>
 */
class StaffWithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-30 days', 'now');

        // Add a random number of minutes (between 0 and 60 minutes) to created_at
        //$createdAt = $createdAt->addMinutes($this->faker->numberBetween(0, 60));
        $createdAt = (new Carbon($createdAt))->addMinutes($this->faker->numberBetween(0, 60));
        //dd($createdAt);
    
        // Generate a random date for updated_at within the last 30 days
        $updatedAt =  $this->faker->dateTimeBetween('-30 days', 'now');
    
        // Make sure updated_at is later than created_at
        while ($updatedAt <= $createdAt) {
            $updatedAt = $this->faker->dateTimeBetween('-30 days', 'now');
        }

        return [
            'amount' => rand(1010, 5000),
            'status' =>  $this->faker->randomElement(['Pending', 'Cancelled', 'Successful']),
            'staff' => rand(1,2),
            'approved_by' => 1,
            'bank_id' => 1,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
