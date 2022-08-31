<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-reservations']);
        Permission::create(['name' => 'edit-reservations']);
        Permission::create(['name' => 'delete-reservations']);

        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'delete-categories']);

        Permission::create(['name' => 'create-tables']);
        Permission::create(['name' => 'edit-tables']);
        Permission::create(['name' => 'delete-tables']);

        Permission::create(['name' => 'create-menus']);
        Permission::create(['name' => 'edit-menus']);
        Permission::create(['name' => 'delete-menus']);

        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $waiterRole = Role::create(['name' => 'Waiter']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-reservations',
            'edit-reservations',
            'delete-reservations',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'create-tables',
            'edit-tables',
            'delete-tables',
            'create-menus',
            'edit-menus',
            'delete-menus',
        ]);

        $managerRole->givePermissionTo([
            'create-reservations',
            'edit-reservations',
            'delete-reservations',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'create-tables',
            'edit-tables',
            'delete-tables',
            'create-menus',
            'edit-menus',
            'delete-menus',
        ]);

        $waiterRole->givePermissionTo([
            'create-reservations',
            'edit-reservations',
            'delete-reservations',
            'edit-tables',
            'create-menus',
            'edit-menus',
            'delete-menus',
        ]);

        $user = User::first();
        $user->assignRole('Admin');

        $manager = User::firstWhere('name', 'Manager');
        $manager->assignRole('Manager');

        $waiter = User::firstWhere('name', 'Obsluha');
        $waiter->assignRole('Waiter');
    }
}
