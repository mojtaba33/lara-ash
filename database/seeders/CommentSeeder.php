<?php

namespace Database\Seeders;

use App\Comment;
use App\Product;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
        Product::all()->map(function($product){
            Comment::factory()->count(random_int(3,7))->create([
                'commentable_id' => $product->id,
                'commentable_type' => get_class($product)
            ]);
            $product->rate = $product->getProductRate();
            $product->save();
        });

    }
}
