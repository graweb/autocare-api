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
        $users = [
            [
                'role_id' => 1,
                'customer_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@autocare.com',
                'password' => 'password',
                'role' => 'Admin',
            ],
            [
                'role_id' => 2,
                'customer_id' => 1,
                'name' => 'Manager',
                'email' => 'manager@autocare.com',
                'password' => 'password',
                'role' => 'Manager',
            ],
            [
                'role_id' => 3,
                'customer_id' => 1,
                'name' => 'User',
                'email' => 'user@autocare.com',
                'password' => 'password',
                'role' => 'User',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'role_id' => $user['role_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
