<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff\Staff;
use App\Models\Payments\StaffWallet;
use App\Models\Payments\StaffBank;
use App\Models\Payments\StaffWithdrawal;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Staff::find(1);

        /** Bank */
        $bank_1 = StaffBank::factory()->create(['account_name' => $user->name(),'default' => 1]);
        $bank_2 = StaffBank::factory()->create(['account_name' => $user->name()]);
        $bank_3 =  StaffBank::factory()->create(['account_name' => $user->name()]);
        $bank_4 = StaffBank::factory()->create(['account_name' => $user->name()]);

        /**Withdrawals */
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_1->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_2->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_3->id]);
        StaffWithdrawal::factory()->create(['bank_id' => $bank_4->id]);

        
        StaffWallet::factory()->create(['staff' => 1]);
        StaffWallet::factory()->create(['staff' => 2]);
    }
}
