<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 's.admin@example.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'role_id' => 2,
        ]);


        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('123456'),
            'role_id' => 3,
        ]);
    }
}
