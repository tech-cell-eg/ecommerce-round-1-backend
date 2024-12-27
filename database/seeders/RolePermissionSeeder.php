<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles
        $roles = [
            'admin',
            'editor',
        ];

        // Define permissions
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        foreach ($roles as $role) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);

            if ($role === 'admin') {
                // Admin gets all permissions
                $roleInstance->syncPermissions(Permission::all());
            }

            if ($role === 'editor') {
                // Editor only manages products
                $roleInstance->syncPermissions([
                    'view products',
                    'create products',
                    'edit products',
                    'delete products',
                ]);
            }
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
