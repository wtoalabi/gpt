<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class QuestionPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_QUESTIONS',
                'model'=> 'Question',
                'description' => 'View All Questions.'
            ]);
    
        Permission::factory()
            ->create([
                'ability' => 'VIEW_QUESTION',
                'model'=> 'Question',
                'description' => 'View Question.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_QUESTION',
                'model'=> 'Question',
                'description' => 'Add new Question.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_QUESTION',
                'model'=> 'Question',
                'description' => 'Edit Question.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_QUESTION',
                'model'=> 'Question',
                'description' => 'Delete Question.'
                ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_QUESTION_STATUS',
                'model'=> 'Question',
                'description' => 'Approve or dissaprove questions.'
                ]);
    }
}
