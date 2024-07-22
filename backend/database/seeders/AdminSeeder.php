<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'user.avif',
            'store_id' => 0
        ]);

        $writer = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'store_id' => 0
        ]);

        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
            'store_id' => 0
        ]);

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'user']);
        $ownerRole = Role::create(['name' => 'owner']);

        // Define permissions
        $permissions = [
            'Post access', 'Post edit', 'Post create', 'Post delete',
            'Role access', 'Role edit', 'Role create', 'Role delete',
            'User access', 'User edit', 'User create', 'User delete',
            'Province access', 'Province edit', 'Province create', 'Province delete',
            'Category access', 'Category edit', 'Category create', 'Category delete',
            'Permission access', 'Permission edit', 'Permission create', 'Permission delete',
            'Slideshow access', 'Slideshow edit', 'Slideshow create', 'Slideshow delete',
            'Mail access', 'Mail edit',
            'Service access', 'Service edit', 'Service create', 'Service delete', 'Service show',
            'Payment access', 'Payment create',
            'Booking access', 'Booking create', 'Booking show','Schedule access','Schedule show', 'Report access'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign roles to users
        $admin->assignRole($adminRole);
        $writer->assignRole($writerRole);
        $owner->assignRole($ownerRole);

        // Permissions to be excluded for admin role
        $excludedAdminPermissions = ['Post access','Report access','Schedule access','Booking access'];

        // Permissions for admin role
        $adminPermissions = array_diff($permissions, $excludedAdminPermissions);

        // Assign permissions to roles
        $adminRole->syncPermissions($adminPermissions);

        // Assign specific permissions to owner
        $ownerPermissions = ['Service access', 'Service show', 'Service create', 'Service edit', 'Service delete', 'Booking access', 'Booking show', 'Payment create', 'Province access', 'Category access', 'Schedule access', 'Schedule show', 'Report access'];
        $ownerRole->givePermissionTo($ownerPermissions);
    }
}
