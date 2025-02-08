<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate([
            'name' => "System Admin",
            'is_deletable' => false
        ]);

        $role->permissions()->sync(Permission::all()->pluck('id'));
    }
}
