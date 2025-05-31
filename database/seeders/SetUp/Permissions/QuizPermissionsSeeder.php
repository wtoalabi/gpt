<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class QuizPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_QUIZ',
                'model'=> 'Quiz',
                'description' => 'View Quiz.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_QUIZ',
                'model'=> 'Quiz',
                'description' => 'Add new Quiz.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_QUIZ',
                'model'=> 'Quiz',
                'description' => 'Edit Quiz.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_QUIZ',
                'model'=> 'Quiz',
                'description' => 'Delete Quiz.'
                ]);
    }
}
