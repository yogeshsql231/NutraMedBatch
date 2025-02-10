<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPassword = Hash::make('Admin@12345');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => $adminPassword,
        ]);


        User::create([
            'name' => 'yogendra singh',
            'email' => 'yogendra.singh@corewebconnections.com',
            'email_verified_at' => now(),
            'password' => $adminPassword,
        ]);
    }
}
