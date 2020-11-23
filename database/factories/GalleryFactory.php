<?php

namespace Database\Factories;

use App\Gallery;
use App\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'image' => [
                '125'        => 'upload/faker/90.jpg',
                '420'       => 'upload/faker/420.jpg',
            ],
        ];
    }
}
