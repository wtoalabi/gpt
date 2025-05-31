<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class RolesPermissionsPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_ROLE_PERMISSION',
                'model'=> 'RolePermission',
                'description' => 'View Role Permission'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_ROLE_PERMISSION',
                'model'=> 'RolePermission',
                'description' => 'Edit Role Permissions'
            ]);
        
    }
}
