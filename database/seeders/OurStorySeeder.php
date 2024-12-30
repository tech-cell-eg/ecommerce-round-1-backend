<?php

namespace Database\Seeders;

use App\Models\OurStory;
use Database\Factories\OurStoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OurStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OurStory::factory(100)->create();
    }
}
