<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'stations.create']);
        Permission::create(['name' => 'stations.update']);
        Permission::create(['name' => 'stations.delete']);
        Permission::create(['name' => 'stations.view']);

        // create roles
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.update']);
        Permission::create(['name' => 'role.delete']);
        Permission::create(['name' => 'role.view']);

        // users
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.delete']);
        Permission::create(['name' => 'user.view']);

        // Other permissions
        Permission::create(['name' => 'manage']);
        Permission::create(['name' => 'google-maps']);
        Permission::create(['name' => 'node-data']);
        Permission::create(['name' => 'two-meter']);
        Permission::create(['name' => 'ten-meter']);
        Permission::create(['name' => 'ground-node']);
        Permission::create(['name' => 'logs']);
        Permission::create(['name' => 'analytics']);
        Permission::create(['name' => 'problem-archive']);
        Permission::create(['name' => 'maillist']);
        Permission::create(['name' => 'downloads']);
        Permission::create(['name' => 'import-data']);
        Permission::create(['name' => 'live-data']);
        Permission::create(['name' => 'dashboard']);
        // 

        // create super admin

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
