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
        $categories = ["men", "women", "kids", "bags", "belts", "wallets", "watches", "accessories", "winter wear","foot wear", "casual wear", "western wear", "ethnic wear", "indian & festive wear"];
        foreach ($categories as $category) {
            Category::create(["name" => $category]);
        }
    }
}
