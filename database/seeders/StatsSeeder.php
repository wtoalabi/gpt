<?php

namespace Database\Seeders;

use App\Http\Helpers\StatsGenerator;
use App\Models\Events\EventEntity;
use App\Models\Stats;
use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        StatsGenerator::Run();
    }

}
