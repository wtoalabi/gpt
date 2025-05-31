<?php

namespace Database\Factories\Base\Authorization;

use App\Models\Base\Authorization\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Guest',
            'description' => 'Guest user with very few privilege',
            'isCore' => 1
        ];
    }
}
