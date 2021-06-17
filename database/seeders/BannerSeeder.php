<?php

namespace Database\Seeders;

use App\Banner;
use App\Category;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::truncate();

        $categories = Category::has('products')->where('parent_id','!=',0)->get()->random(6);

        Banner::factory()->create([
            'title' => 'Women’s fashion',
            'url' => 'category/' . $categories[0]->slug,
            'image' => 'upload/faker/left-banner.jpg',
            'position' => 'left',
            'description' => 'Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore edolore magna aliquapendisse ultrices gravida.',
        ]);

        Banner::factory()->create([
            'title' => 'Men’s fashion',
            'url' => 'category/' . $categories[1]->slug,
            'image' => 'upload/faker/1600866707-category-2.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Men’s fashion',
            'url' => 'category/' . $categories[2]->slug,
            'image' => 'upload/faker/1600866707-category-2.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Kid’s fashion',
            'url' => 'category/' . $categories[3]->slug,
            'image' => 'upload/faker/1600867792-category-3.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Cosmetics',
            'url' => 'category/' . $categories[4]->slug,
            'image' => 'upload/faker/1600867818-category-4.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Accessories',
            'url' => 'category/' . $categories[5]->slug,
            'image' => 'upload/faker/1600867966-category-5',
            'position' => 'right',
            'description' => '',
        ]);
    }
}
