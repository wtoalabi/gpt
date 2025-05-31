<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class StatsPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_STATS',
                'model'=> 'STAT',
                'description' => 'View STATs list.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_STAT',
                'model'=> 'STAT',
                'description' => 'Add new STAT.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_STAT',
                'model'=> 'STAT',
                'description' => 'Edit STAT.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_STAT',
                'model'=> 'STAT',
                'description' => 'Delete STAT.'
                ]);
    }
}
