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

      


        $this->call([
            CategorySeeder::class,
            SubCategorySeeder::class,
            PermissionTableSeeder::class,
            AdminSeeder::class,
            TestimonialSeeder::class,
            OurStorySeeder::class,
            InstagramStoriesSeeder::class,
                      PermissionTableSeeder::class,
            RolePermissionSeeder::class,
        ]);

      
    }
}
