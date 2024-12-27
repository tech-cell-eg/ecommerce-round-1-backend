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
            'super-admin',
            'Product Manager',
            'Category Manager',
            'Testimonials Manager',
            'Orders Manager',
            'Coupons Manager',
            'Blogs Manager',
            'Settings Manager',
            'Contacts Manager',
            'Users Manager',
        ];

        // Define permissions for each role
        $rolePermissions = [
            'super-admin' => Permission::all(), // All permissions

            'Product Manager' => [
                'product-list',
                'product-create',
                'product-edit',
                'product-delete',
            ],

            'Category Manager' => [
                'category-list',
                'category-create',
                'category-edit',
                'category-delete',
            ],

            'Testimonials Manager' => [
                'testimonials-list',
                'testimonials-create',
                'testimonials-edit',
                'testimonials-delete',
            ],

            'Orders Manager' => [
                'order-list',
                'order-create',
                'order-edit',
                'order-delete',
            ],

            'Coupons Manager' => [
                'coupons-list',
                'coupons-create',
                'coupons-edit',
                'coupons-delete',
            ],

            'Blogs Manager' => [
                'blog-list',
                'blog-create',
                'blog-edit',
                'blog-delete',
            ],

            'Settings Manager' => [
                'setting-list',
                'setting-create',
                'setting-edit',
                'setting-delete',
            ],

            'Contacts Manager' => [
                'contact-list',
                'contact-create',
                'contact-edit',
                'contact-delete',
            ],

            'Users Manager' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $role) {
            $roleInstance = Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'admin',
            ]);

            // Assign permissions to the role
            if (isset($rolePermissions[$role])) {
                $roleInstance->syncPermissions($rolePermissions[$role]);
            }
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}