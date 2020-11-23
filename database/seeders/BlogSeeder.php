<?php

namespace Database\Seeders;

use App\Blog;
use App\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::truncate();

        Category::factory()
            ->has(Category::factory()
                ->has(Blog::factory()
                    ->count(10), 'blogs')
                ->count(5), 'children')
            ->count(3)
            ->create();
    }
}
