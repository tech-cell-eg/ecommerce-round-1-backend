<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(["name" => "men"]);
        Category::create(["name" => "women"]);
        Category::create(["name" => "kids"]);
        Category::create(["name" => "bags"]);
        Category::create(["name" => "belts"]);
        Category::create(["name" => "wallets"]);
        Category::create(["name" => "watches"]);
        Category::create(["name" => "accessories"]);
        Category::create(["name" => "winter wear"]);
        Category::create(["name" => "foot wear"]);
        Category::create(["name" => "casual wear"]);
        Category::create(["name" => "western wear"]);
        Category::create(["name" => "ethnic wear"]);
        Category::create(["name" => "indian & festive wear"]);
    }
}
