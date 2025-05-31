<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class SettingPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_SETTINGS',
                'model'=> 'Setting',
                'description' => 'View Setting.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_SETTING',
                'model'=> 'Setting',
                'description' => 'Add new Setting.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_STAFF_SETTING',
                'model'=> 'SettingSetting',
                'description' => 'Edit Staff Settings'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_SETTING',
                'model'=> 'Setting',
                'description' => 'Edit Setting.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_SETTING',
                'model'=> 'Setting',
                'description' => 'Delete Setting.'
                ]);
    }
}
