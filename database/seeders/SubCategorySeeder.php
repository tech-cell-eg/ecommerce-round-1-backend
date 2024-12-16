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
        $subCategories = [
            "1" => ["t-shirts", "casual shirts", "formal shirts", "jackets", "blazers & coats"],
            "2" => ["kurtas & suits", "jackets", "sarees", "ethnic wear", "lehenga cholis"],
            "3" => ["t-shirts", "shirts", "jeans", "trousers", "party wear", "inner wear & thermal", "track pants", "value pack"],
            "10" => ["flats", "casual shoes", "heels", "boots", "sports shoes & floaters"],
            "14" => ["kurtas & kurta sets", "sherwanis"],
            "12" => ["dresses", "jumpsuits"]
        ];

        foreach ($subCategories as $category_id => $sub_categories) {
            foreach ($sub_categories as $sub_category) {
                SubCategory::create(["name" => $sub_category, "category_id" => $category_id]);
            }
        }

    }
}
