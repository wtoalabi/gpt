<?php

namespace Database\Seeders\SetUp\Permissions;

use App\Models\Base\Authorization\Permission;
use Illuminate\Database\Seeder;

class PaymentsPermissionsSeeder extends Seeder
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
                'ability' => 'VIEW_PAYMENTS',
                'model'=> 'Payment',
                'description' => 'View Payment.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'CREATE_PAYMENT',
                'model'=> 'Payment',
                'description' => 'Add new Payment.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'UPDATE_PAYMENT',
                'model'=> 'Payment',
                'description' => 'Edit Payment.'
            ]);

        Permission::factory()
            ->create([
                'ability' => 'DELETE_PAYMENT',
                'model'=> 'Payment',
                'description' => 'Delete Payment.'
                ]);
            
            /**STAFF BANK */
            Permission::factory()
            ->create([
                'ability' => 'VIEW_STAFF_BANKS',
                'model'=> 'StaffBank',
                'description' => 'View Staff Banks'
            ]);
    
            Permission::factory()
                ->create([
                    'ability' => 'CREATE_STAFF_BANK',
                    'model'=> 'StaffBank',
                    'description' => 'Add new Staff Bank.'
                ]);
    
            Permission::factory()
                ->create([
                    'ability' => 'UPDATE_STAFF_BANK',
                    'model'=> 'StaffBank',
                    'description' => 'Edit Staff Bank.'
                ]);
    
            Permission::factory() 
                ->create([
                    'ability' => 'DELETE_STAFF_BANK',
                    'model'=> 'StaffBank',
                    'description' => 'Delete Staff Bank.'
                    ]);
            /** Staff Wallet */
            Permission::factory()
            ->create([
                'ability' => 'VIEW_STAFF_WALLET',
                'model'=> 'StaffWallet',
                'description' => 'View Staff Wallets'
            ]);

            Permission::factory()
                ->create([
                    'ability' => 'CREATE_STAFF_WALLET',
                    'model'=> 'StaffWallet',
                    'description' => 'Add new Staff Wallet.'
                ]);

            Permission::factory()
                ->create([
                    'ability' => 'UPDATE_STAFF_WALLET',
                    'model'=> 'StaffWallet',
                    'description' => 'Edit Staff Wallet.'
                ]);

            Permission::factory() 
                ->create([
                    'ability' => 'DELETE_STAFF_WALLET',
                    'model'=> 'StaffWallet',
                    'description' => 'Delete Staff Wallet.'
                    ]);
            /**STAFF Withdrawal */
        
            Permission::factory()
                ->create([
                    'ability' => 'VIEW_ALL_WITHDRAWALS',
                    'model'=> 'StaffWithdrawal',
                    'description' => 'View All Staff Withdrawals'
            ]);

            Permission::factory()
                ->create([
                    'ability' => 'VIEW_STAFF_WITHDRAWAL',
                    'model'=> 'StaffWithdrawal',
                    'description' => 'View Staff Withdrawals'
            ]);

            Permission::factory()
                ->create([
                    'ability' => 'CREATE_STAFF_WITHDRAWAL',
                    'model'=> 'StaffWithdrawal',
                    'description' => 'Add new Staff Withdrawal.'
                ]);

            Permission::factory()
                ->create([
                    'ability' => 'UPDATE_STAFF_WITHDRAWAL',
                    'model'=> 'StaffWithdrawal',
                    'description' => 'Edit Staff Withdrawal.'
                ]);
    }
}
