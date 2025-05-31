<?php
    
    namespace Database\Seeders\SetUp;
    
    use Illuminate\Database\Seeder;
    use Database\Seeders\SetUp\ExamSeeder;
    use Database\Seeders\StaffSeeder;
    use Database\Seeders\PaymentSeeder;
    use Database\Seeders\StatsSeeder;
    use Database\Seeders\SetUp\SubjectSeeder;
    use Database\Seeders\SetUp\QuestionSeeder;
    
    class InitialSetup extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {
            //$this->call(UsersTableSeeder::class);
            $this->call(PermissionsSeeder::class);
            $this->call(RolesSeeder::class);
            $this->call(SuperAdminSeeder::class);
            $this->call(StaffSeeder::class);
           
            $this->call(StatsSeeder::class);


            $this->call(ExamSeeder::class);
            $this->call(PaymentSeeder::class);

            //$this->call(QuestionSeeder::class);
            
    
        }
    }

