<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //    ]);

        // $this->call([
        //     PermissionTableSeeder::class,
        //     AdminSeeder::class,
        //     TestimonialSeeder::class,
        //     CategorySeeder::class,
        //     SubCategorySeeder::class,
        //     InstagramStoriesSeeder::class
        // ]);
        // $this->call([
        //     PermissionTableSeeder::class,
        //     AdminSeeder::class,
        //     TestimonialSeeder::class,
        //     CategorySeeder::class,
        //     SubCategorySeeder::class
        // ]);


        // Category::factory()->count(3)->create();
        // Product::factory(5)->create();

        // $this->call([
        //     RolePermissionSeeder::class,
        // ]);
        $this->call([
            PermissionTableSeeder::class,
            RolePermissionSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
