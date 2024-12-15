<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create(["name" => "t-shirts", "category_id" => "1"]);
        SubCategory::create(["name" => "casual shirts", "category_id" => "1"]);
        SubCategory::create(["name" => "formal shirts", "category_id" => "1"]);
        SubCategory::create(["name" => "jackets", "category_id" => "1"]);
        SubCategory::create(["name" => "blazers & coats", "category_id" => "1"]);
        SubCategory::create(["name" => "kurtas & suits", "category_id" => "2"]);
        SubCategory::create(["name" => "jackets", "category_id" => "2"]);
        SubCategory::create(["name" => "sarees", "category_id" => "2"]);
        SubCategory::create(["name" => "ethnic wear", "category_id" => "2"]);
        SubCategory::create(["name" => "lehenga cholis", "category_id" => "2"]);
        SubCategory::create(["name" => "t-shirts", "category_id" => "3"]);
        SubCategory::create(["name" => "shirts", "category_id" => "3"]);
        SubCategory::create(["name" => "jeans", "category_id" => "3"]);
        SubCategory::create(["name" => "trousers", "category_id" => "3"]);
        SubCategory::create(["name" => "party wear", "category_id" => "3"]);
        SubCategory::create(["name" => "inner wear & thermal", "category_id" => "3"]);
        SubCategory::create(["name" => "track pants", "category_id" => "3"]);
        SubCategory::create(["name" => "value pack", "category_id" => "3"]);
        SubCategory::create(["name" => "flats", "category_id" => "10"]);
        SubCategory::create(["name" => "casual shoes", "category_id" => "10"]);
        SubCategory::create(["name" => "heels", "category_id" => "10"]);
        SubCategory::create(["name" => "boots", "category_id" => "10"]);
        SubCategory::create(["name" => "sports shoes & floaters", "category_id" => "10"]);
        SubCategory::create(["name" => "kurtas & kurta sets", "category_id" => "14"]);
        SubCategory::create(["name" => "sherwanis", "category_id" => "14"]);
        SubCategory::create(["name" => "dresses", "category_id" => "12"]);
        SubCategory::create(["name" => "jumpsuits", "category_id" => "12"]);
    }
}
