<?php
    /**
     * Created by Alabi Olawale
     * Date: 11/20/2021
     */
    
    namespace Database\Seeders\SetUp;
    
    use App\Models\Base\Authorization\Permission;
    use App\Models\Base\Authorization\Role;
    use App\Models\Settings\StaffSetting;
    use App\Models\Staff\Staff;
    use Illuminate\Database\Seeder;

    class SuperAdminSeeder extends Seeder
    {
        public function run() {
            $role = Role::first();
            
            $super_admin = Staff::factory()->create(['email' => 'a@ab.com']);
            $super_admin->roles()->sync([$role->id]);

            $permissions = Permission::all()->pluck('id')->toArray();
            $role->permissions()->sync($permissions);
           
            StaffSetting::create([
                'name' => 'per_question_amount_uploader',
                'description' => 'How much does an uploaded question worth?',
                'title' => 'Per Uploaded Question Amount',
                'value' => 15,
            ]);
           
            StaffSetting::create([
                'name' => 'per_question_amount_approval',
                'description' => 'How much does an approved question worth?',
                'title' => 'Per Approved Question Amount',
                'value' => 10,
            ]);

            StaffSetting::create([
                'name' => 'threshold_amount',
                'description' => 'What is the minimum amount to be held in threshold?',
                'title' => 'Threshold Amount',
                'value' => 1000,
            ]);

            StaffSetting::create([
                'name' => 'minimum_withdrawable_amount',
                'description' => 'What is the minimum withdrawable amount?',
                'title' => 'Minimum Withdrawable Amount',
                'value' => 500,
            ]);

        }
    }
