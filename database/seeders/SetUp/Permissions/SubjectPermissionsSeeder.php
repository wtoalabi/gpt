<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class SubjectPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Permission::factory()
            ->create([
                'ability' => 'VIEW_SUBJECTS',
                'model'=> 'Subject',
                'description' => 'View All Subjects.'
            ]);
        
    
        Permission::factory()
            ->create([
                'ability' => 'VIEW_SUBJECT',
                'model'=> 'Subject',
                'description' => 'View Subject.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_SUBJECT',
                'model'=> 'Subject',
                'description' => 'Add new Subject.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_SUBJECT',
                'model'=> 'Subject',
                'description' => 'Edit Subject.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_SUBJECT',
                'model'=> 'Subject',
                'description' => 'Delete Subject.'
                ]);
            }
        
}
