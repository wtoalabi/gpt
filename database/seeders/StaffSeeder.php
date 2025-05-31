<?php

namespace Database\Seeders;

use App\Models\Staff\Staff;
use Illuminate\Database\Seeder;
use App\Models\Base\Authorization\Role;
use App\Models\Base\Authorization\Permission;

use Faker\Factory as Faker;
class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $role = Role::find(3);
            $staff = Staff::factory()->create(['email' => 's@s.com']);
            $staff->roles()->sync([$role->id]);
    }
}
