<?php

namespace Database\Factories;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Staff::class;
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'status' => 1,
            'profile_image' => '',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('abc123'),
        ];
    }
}
