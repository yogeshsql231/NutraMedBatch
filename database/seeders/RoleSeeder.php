<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);


        Role::create([
            'name' => 'guest',
            'guard_name' => 'web'
        ]);


        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('Admin@12345'),
            ]
        );

        $admin->assignRole('admin');
    }
}
