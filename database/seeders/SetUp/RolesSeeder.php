<?php
    
    namespace Database\Seeders\SetUp;
    
    use App\Models\Base\Authorization\Role;
    use App\Models\Staff\Staff;
    use Illuminate\Database\Seeder;
    
    class RolesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            Role::factory()
                ->create([
                    'title' => 'Super Admin',
                    'description' => 'A super admin with all the privileges',
                    'isCore' => true
                ]);
    
            Role::factory()
                ->create([
                    'title' => 'Admin',
                    'description' => 'An admin with some privileges',
                    'isCore' => true
                ]);
    
            Role::factory()
                ->create([
                    'title' => 'Staff',
                    'description' => 'A staff role with some privileges',
                    'isCore' => true
                ]);
    
            Role::factory()
                ->create([
                    'title' => 'Uploader',
                    'description' => 'A staff role with uploading privileges',
                    'isCore' => true
                ]);
    
            
            Role::factory()
                ->create([
                    'title' => 'Reviewer',
                    'description' => 'A staff role with reviewing privileges',
                    'isCore' => true
                ]);
            
            
          /*
            
            Role::factory()
                ->create([
                    'title' => 'Agent',
                    'description' => 'A sales agent/rep with store limited privileges',
                    'isCore' => true
                ]);
            
            Role::factory()
                ->create([
                    'title' => 'Sponsor',
                    'description' => 'An event sponsor',
                    'isCore' => true
                ]);*/
            
        }
    }
