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
        Category::factory()
            ->has(Category::factory()
                ->has(Product::factory()
                    ->has(Gallery::factory()->count(3),'galleries')
                    ->count(10), 'products')
                ->count(5), 'children')
            ->count(3)
            ->create();
    }
}
