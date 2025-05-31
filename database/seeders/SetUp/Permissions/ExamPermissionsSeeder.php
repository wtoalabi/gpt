<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class ExamPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_EXAMS',
                'model'=> 'Exam',
                'description' => 'View All Exams.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'VIEW_EXAM',
                'model'=> 'Exam',
                'description' => 'View Exam.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_EXAM',
                'model'=> 'Exam',
                'description' => 'Add new Exam.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_EXAM',
                'model'=> 'Exam',
                'description' => 'Edit Exam.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_EXAM',
                'model'=> 'Exam',
                'description' => 'Delete Exam.'
                ]);
    }
}
