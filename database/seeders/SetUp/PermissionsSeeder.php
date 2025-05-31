<?php
    
    namespace Database\Seeders\SetUp;
    
    
    use App\Models\Base\Authorization\Permission;
    use Database\Seeders\SetUp\Permissions\RolesPermissionsPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\RolesPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\StaffPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\StatsPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\ExamPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\SubjectPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\QuizPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\QuestionPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\SettingPermissionsSeeder;
    use Database\Seeders\SetUp\Permissions\PaymentsPermissionsSeeder;
    use App\Models\Base\Authorization\Role;

    use Illuminate\Database\Seeder;
    
    class PermissionsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            $this->call(StaffPermissionsSeeder::class);
            $this->call(RolesPermissionsPermissionsSeeder::class);
            $this->call(RolesPermissionsSeeder::class);
            $this->call(StatsPermissionsSeeder::class);
            $this->call(ExamPermissionsSeeder::class);
            $this->call(SubjectPermissionsSeeder::class);
            $this->call(QuizPermissionsSeeder::class);
            $this->call(QuestionPermissionsSeeder::class);
            $this->call(SettingPermissionsSeeder::class);
            $this->call(PaymentsPermissionsSeeder::class);
            Permission::factory()
                ->create([
                    'ability' => 'VIEW_ACTIVITY', 'model' => 'Activity', 'description' => 'View Activities'
                ]);
            
            }
    }
