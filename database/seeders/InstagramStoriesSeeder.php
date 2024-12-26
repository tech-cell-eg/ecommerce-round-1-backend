<?php

namespace Database\Seeders;

use App\Models\InstagramStories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstagramStoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stories = [
            [
                "image_link" => "https://kishahaldiamakeup.in/wp-content/uploads/2019/07/aiony-haust-IXYxqP4zejo-unsplash-1-1.jpg",
                "insta_link" => "https://www.instagram.com/p/C4H8VWxq3Oc/?igsh=ejh6bjQzZjByNXBh"
            ],
            [
                "image_link" => "https://www.thetotalbusiness.com/wp-content/uploads/2024/06/fashion-girl-the-total-business-320x495.jpg.webp",
                "insta_link" => "https://www.instagram.com/p/DBzF1NoqNF7/?img_index=8&igsh=eWtvNDBzbmJ6ZDh3"
            ],
            [
                "image_link" => "https://m.media-amazon.com/images/I/81esBxTM+-L.AC_SY575.jpg",
                "insta_link" => "https://www.instagram.com/reel/CzF1e5Bvg6M/?igsh=MXVjZ215aTkzMjRu"
            ],
            [
                "image_link" => "https://guideinua.b-cdn.net/images/logo_new/202/20123344/logo.webp",
                "insta_link" => "https://www.instagram.com/p/DDj32M7uTcP/?img_index=2&igsh=MTFob2oyeWx4NDRyMg=="
            ]
        ];

        foreach ($stories as $story) {
            InstagramStories::create($story);
        }
    }
}
