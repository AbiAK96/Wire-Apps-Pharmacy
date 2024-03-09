<?php

namespace Database\Seeders;

use App\Models\V1\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $owner = User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=> '2022-01-02 17:04:58',
            'role'=> 'owner',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $owner->assignRole('owner');

        $manager = User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=> '2022-01-02 17:04:58',
            'role'=> 'manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager->assignRole('manager');

        $cashier = User::create([
            'name' => 'cashier',
            'email' => 'cashier@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=> '2022-01-02 17:04:58',
            'role'=> 'cashier',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $cashier->assignRole('cashier');
    }
}
