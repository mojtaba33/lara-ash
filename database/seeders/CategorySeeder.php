<?php

namespace Database\Seeders;

use App\Category;
use App\Gallery;
use App\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Category::truncate();
        Gallery::truncate();

        Category::factory()
            ->has(Category::factory()
                ->has(Product::factory()
                    ->has(Gallery::factory()->count(3),'galleries')
                    ->count(10), 'products')
                ->count(4), 'children')
            ->count(3)
            ->create();
    }
}
