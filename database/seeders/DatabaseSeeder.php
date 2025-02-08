<?php

namespace Database\Seeders;

use App\Models\HotelModel;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]);


        HotelModel::factory()->create([
            'name' => 'Super Admin',
            'description' => 'admin@example.com',
            'location' => bcrypt('123456'),
            'role_id' => 1,
        ]);



        $adminRole = RoleModel::create(['name' => 'admin']);
        $userRole = RoleModel::create(['name' => 'user']);

        $manageUsers = PermissionModel::create(['name' => 'manage_users']);
        $viewDashboard = PermissionModel::create(['name' => 'view_dashboard']);

        $adminRole->permissions()->attach([$manageUsers->id, $viewDashboard->id]);
        $userRole->permissions()->attach([$viewDashboard->id]);

        //$admin = User::find(1);
        $admin->role()->associate($adminRole);
        $admin->save();
    }
}
