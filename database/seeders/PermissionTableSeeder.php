<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',


            'role-list',
            'role-create',
            'role-edit',
            'role-delete',


            'product-list',
            'product-create',
            'product-edit',
            'product-delete',


            
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',


            'contact-list',
            'contact-create',
            'contact-edit',
            'contact-delete',


            'coupons-list',
            'coupons-create',
            'coupons-edit',
            'coupons-delete',


            'order-list',
            'order-create',
            'order-edit',
            'order-delete',


            'setting-list',
            'setting-create',
            'setting-edit',
            'setting-delete',



            'testimonials-list',
            'testimonials-create',
            'testimonials-edit',
            'testimonials-delete',


        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'admin',
                ]);
            }
        }
    }
}
