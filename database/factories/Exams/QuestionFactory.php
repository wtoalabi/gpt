<?php

namespace Database\Factories\Exams;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exams\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'intro' => $this->faker->randomElement([$this->faker->realText(rand(50,200)), null, null, null, null, null, null, null, null, null]),
            'question' => $this->faker->realText(rand(50,100)),
            'options' => json_encode([
                'A' => $this->faker->realText(rand(10,150)),
                'B' => $this->faker->realText(rand(20,150)),
                'C' => $this->faker->realText(rand(30,150)),
                'D' => $this->faker->realText(rand(40,150)),
                ]),
            'number' => 0,
            'status' => rand(0,1),
            'answer' => $this->faker->randomElement(['A','B','C','D']),
            'explain' => $this->faker->realText(rand(300,600)),
            'year' => '2010',
            'created_by' => 1,
        ];
    }
}