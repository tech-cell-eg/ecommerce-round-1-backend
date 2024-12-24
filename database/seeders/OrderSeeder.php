<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $orders = Order::factory(100)->create();
        $products = Product::factory(100)->create();
        $orders->first()->products()->attach($products, [
            'price' => rand(1, 999),
            'quantity' => rand(1, 10),
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
        ]);
    }
}
