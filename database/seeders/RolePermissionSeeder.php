<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create roles
        $roles = [
            'SuperAdmin',
            'Admin',
            'User',
        ];

        // create permissions
        $permissions = [
            'create',
            'edit',
            'delete',
            'view',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // create roles and assign permissions
        $superadmin = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $user = Role::firstOrCreate(['name' => 'User']);

        $superadmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(['create', 'edit', 'view']);
        $user->givePermissionTo(['view']);
    }
}
