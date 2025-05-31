<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class StaffPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_STAFF',
                'model'=> 'Staff',
                'description' => 'View Staff.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_STAFF',
                'model'=> 'Staff',
                'description' => 'Add new Staff.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_STAFF',
                'model'=> 'Staff',
                'description' => 'Edit Staff.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_STAFF',
                'model'=> 'Staff',
                'description' => 'Delete Staff.'
                ]);

        Permission::factory()
        ->create([
            'ability' => 'RESET_STAFF_POST_COUNT',
            'model'=> 'Staff',
            'description' => 'Reset Staff Questions Post Count'
            ]);
    }
}
