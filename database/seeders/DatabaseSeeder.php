<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
           ]);

        $this->call([
            PermissionTableSeeder::class,
            AdminSeeder::class,
<<<<<<< HEAD
            TestimonialSeeder::class,
=======
            CategorySeeder::class,
            SubCategorySeeder::class
>>>>>>> bf8f32c97afc01f770044e60a9763e0572ece15e
        ]);
    }
}
