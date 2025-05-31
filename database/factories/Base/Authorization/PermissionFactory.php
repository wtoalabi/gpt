<?php

namespace Database\Factories\Base\Authorization;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Permission::class;
    public function definition()
    {
        return [
            'ability' => "CAN_VIEW",
            'model' => "Staff",
            'description' => 'Can view staff',
        ];
    }
}
