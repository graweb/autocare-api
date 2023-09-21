<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'Admin']);
        $role_manager = Role::create(['name' => 'Manager']);
        $role_basic = Role::create(['name' => 'User']);

        $user_read = Permission::create(['name' => 'read users']);
        $user_create = Permission::create(['name' => 'create users']);
        $user_edit = Permission::create(['name' => 'edit users']);
        $user_delete = Permission::create(['name' => 'delete users']);

        $role_read = Permission::create(['name' => 'read roles']);
        $role_create = Permission::create(['name' => 'create roles']);
        $role_edit = Permission::create(['name' => 'edit roles']);
        $role_delete = Permission::create(['name' => 'delete roles']);

        $permission_read = Permission::create(['name' => 'read permissions']);
        $permission_create = Permission::create(['name' => 'create permissions']);
        $permission_edit = Permission::create(['name' => 'edit permissions']);
        $permission_delete = Permission::create(['name' => 'delete permissions']);

        $vehicle_read = Permission::create(['name' => 'read vehicles']);
        $vehicle_create = Permission::create(['name' => 'create vehicles']);
        $vehicle_edit = Permission::create(['name' => 'edit vehicles']);
        $vehicle_delete = Permission::create(['name' => 'delete vehicles']);

        $maintenance_read = Permission::create(['name' => 'read maintenance']);
        $maintenance_create = Permission::create(['name' => 'create maintenance']);
        $maintenance_edit = Permission::create(['name' => 'edit maintenance']);
        $maintenance_delete = Permission::create(['name' => 'delete maintenance']);

        $workshop_read = Permission::create(['name' => 'read workshops']);
        $workshop_create = Permission::create(['name' => 'create workshops']);
        $workshop_edit = Permission::create(['name' => 'edit workshops']);
        $workshop_delete = Permission::create(['name' => 'delete workshops']);

        $expense_read = Permission::create(['name' => 'read expenses']);
        $expense_create = Permission::create(['name' => 'create expenses']);
        $expense_edit = Permission::create(['name' => 'edit expenses']);
        $expense_delete = Permission::create(['name' => 'delete expenses']);

        $permissions_admin = [$user_read, $user_create, $user_edit, $user_delete,
        $role_read, $role_create, $role_edit, $role_delete,
        $permission_read, $permission_create, $permission_edit, $permission_delete,
        $vehicle_read, $vehicle_create, $vehicle_edit, $vehicle_delete,
        $maintenance_read, $maintenance_create, $maintenance_edit, $maintenance_delete,
        $workshop_read, $workshop_create, $workshop_edit, $workshop_delete,
        $expense_read, $expense_create, $expense_edit, $expense_delete
    ];

        $role_admin->syncPermissions($permissions_admin);
        $role_manager->givePermissionTo($user_read, $user_create);
        $role_basic->givePermissionTo($user_read);
    }
}
