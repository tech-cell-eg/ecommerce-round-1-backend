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
            'productsManager',
            'categoriesManager',
            'editor',
        ];

        // Define permissions
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'manage categories',
            'manage products',
            'manage orders',
            'manage settings',
            'manage blogs',
            'manage contacts',
            'manage coupons',
            'manage products',
            'manage testimonials'


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
            
            if ($role === 'productsManager') {
                // Editor only manages products
                $roleInstance->syncPermissions([
                    'manage products'
                ]);
            }

            if ($role === 'categoriesManager') {
                // Editor only manages products
                $roleInstance->syncPermissions([
                    'manage categories'
                ]);
            }
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
