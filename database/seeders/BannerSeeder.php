<?php

namespace Database\Seeders;

use App\Banner;
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

        Banner::factory()->create([
            'title' => 'Women’s fashion',
            'url' => 'google.com',
            'image' => 'upload/faker/left-banner.jpg',
            'position' => 'left',
            'description' => 'Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore edolore magna aliquapendisse ultrices gravida.',
        ]);

        Banner::factory()->create([
            'title' => 'Men’s fashion',
            'url' => 'google.com',
            'image' => 'upload/faker/1600866707-category-2.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Men’s fashion',
            'url' => 'google.com',
            'image' => 'upload/faker/1600866707-category-2.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Kid’s fashion',
            'url' => 'google.com',
            'image' => 'upload/faker/1600867792-category-3.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Cosmetics',
            'url' => 'google.com',
            'image' => 'upload/faker/1600867818-category-4.jpg',
            'position' => 'right',
            'description' => '',
        ]);

        Banner::factory()->create([
            'title' => 'Accessories',
            'url' => 'google.com',
            'image' => 'upload/faker/1600867966-category-5',
            'position' => 'right',
            'description' => '',
        ]);
    }
}
