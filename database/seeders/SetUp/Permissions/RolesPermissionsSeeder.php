<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()
            ->create([
                'ability' => 'VIEW_ROLE',
                'model'=> 'Role',
                'description' => 'View Role.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_ROLE',
                'model'=> 'Role',
                'description' => 'Add new Role.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_ROLE',
                'model'=> 'Role',
                'description' => 'Edit Role.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_ROLE',
                'model'=> 'Role',
                'description' => 'Delete Role.'
                ]);
    }
}
