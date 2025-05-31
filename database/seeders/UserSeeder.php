<?php

namespace Database\Seeders;


use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use function Symfony\Component\Routing\Loader\Configurator\collection;

use Faker\Generator;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = app(Generator::class);
        $user = User::factory()->create(['email' =>  'a@a.com','first_name' => 'Max', 'last_name' => 'Adeoti', 'status' => 1]);
        
    }
       
}