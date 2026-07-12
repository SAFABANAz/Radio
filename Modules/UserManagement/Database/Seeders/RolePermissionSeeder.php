<?php

namespace Modules\UserManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'administrator', 'display_name' => 'Administrator'],
            ['name' => 'operator', 'display_name' => 'Operator'],
            ['name' => 'bank_employee', 'display_name' => 'Bank Employee'],
            ['name' => 'customer', 'display_name' => 'Customer'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name'], 'guard_name' => 'web'], ['display_name' => $role['display_name']]);
        }

        $permissions = [
            ['name' => 'users.view', 'group' => 'Users'],
            ['name' => 'users.create', 'group' => 'Users'],
            ['name' => 'users.update', 'group' => 'Users'],
            ['name' => 'users.delete', 'group' => 'Users'],
            ['name' => 'roles.manage', 'group' => 'Roles'],
            ['name' => 'permissions.manage', 'group' => 'Permissions'],
            ['name' => 'bank-accounts.manage', 'group' => 'Bank Accounts'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name'], 'guard_name' => 'web'], ['group' => $permission['group']]);
        }

        $admin = Role::findByName('administrator', 'web');
        $admin->syncPermissions(Permission::all());
    }
}
