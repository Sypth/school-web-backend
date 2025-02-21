<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
{
    // Create Roles
    $superAdminRole = Role::create(['name' => 'super-admin']);
    $adminRole = Role::create(['name' => 'admin']);
    Role::create(['name' => 'user']);

    // Create Permissions
    $approveChangesPermission = Permission::create(['name' => 'approve-changes']);
    $submitChangesPermission = Permission::create(['name' => 'submit-changes']);

    // Assign Permissions to Roles
    $superAdminRole->givePermissionTo([$approveChangesPermission, $submitChangesPermission]);
    $adminRole->givePermissionTo($submitChangesPermission);

    // Create Super-Admin User
    $superAdmin = User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@example.com',
        'password' => Hash::make('superdeveloper'), 
    ]);
    $superAdmin->assignRole($superAdminRole);

    // Create Admin Users
    $admin1 = User::create([
        'name' => 'Admin One',
        'email' => 'admin1@example.com',
        'password' => Hash::make('developer'),
    ]);
    $admin1->assignRole($adminRole);

    $admin2 = User::create([
        'name' => 'Admin Two',
        'email' => 'admin2@example.com',
        'password' => Hash::make('developer'),
    ]);
    $admin2->assignRole($adminRole);
}
}
