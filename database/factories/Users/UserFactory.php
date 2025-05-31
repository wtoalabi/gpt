<?php

namespace Database\Factories\Users;

use App\Models\Users\User;
use Database\Factories\CustomProviders\en_NG\NG_Custom_Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        $this->faker->addProvider(new NG_Custom_Person($this->faker));
        $gender = collect(['Male', 'Female'])->random();
        $email_provider = collect(['yahoo', 'gmail', 'live', 'hotmail'])->random();
      /*  return [
            'first_name' => $first_name = $this->faker->firstNameFemale,
            'last_name' => $last_name =  $this->faker->lastName,
            'email' => Str::slug($first_name . '_'. $last_name) .Str::random(10). '@' . $email_provider . '.com',
            'phone' => $this->faker->phoneNumber,
            'about' => $this->faker->realText(200),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];*/
    
    
        return [
            'first_name' => $first_name = $this->faker->firstNameMale,
            'last_name' => $last_name =  $this->faker->lastName,
            'email' => Str::slug($first_name . '_'. $last_name) .Str::random(10). '@' . $email_provider . '.com',
            'phone' => $this->faker->phoneNumber,
            'status' => 1,
            'username' => Str::snake($this->faker->firstNameMale),
            'exam' => 'law_school',
            'avatar' => null,
            'subjects' => json_encode(['Criminal Litigation','Corporate Law']),
            'email_verified_at' => now(),
            'password' => bcrypt('abc123')
        ];

    }
}
