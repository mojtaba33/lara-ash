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
    protected $image = [
        'upload/faker/details/thumb-1.jpg',
        'upload/faker/details/thumb-2.jpg',
        'upload/faker/details/thumb-3.jpg',
        'upload/faker/details/thumb-4.jpg',
        'upload/faker/details/product-1.jpg',
        'upload/faker/details/product-2.jpg',
        'upload/faker/details/product-3.jpg',
        'upload/faker/details/product-4.jpg',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = collect($this->image)->random();
        return [
            'product_id' => Product::factory(),
            'image' => [
                '125'        => $image,
                '420'        => $image,
            ],
        ];
    }
}
