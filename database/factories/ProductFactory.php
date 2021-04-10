<?php

namespace Database\Factories;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use function PHPUnit\Framework\directoryExists;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    protected $image = [
        'upload/faker/product-1.jpg',
        'upload/faker/product-2.jpg',
        'upload/faker/product-3.jpg',
        'upload/faker/product-4.jpg',
        'upload/faker/product-5.jpg',
        'upload/faker/product-6.jpg',
        'upload/faker/product-7.jpg',
        'upload/faker/product-8.jpg',
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
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'image' => [
                /*'original'  => $this->faker->image('upload/faker',700, 800, 'fashion'),
                '90'        => $this->faker->image('upload/faker',90, 90, 'fashion'),
                '360'       => $this->faker->image('upload/faker',260, 360, 'fashion'),
                '420'       => $this->faker->image('upload/faker',420, 550, 'fashion'),*/
                'original'  => $image,
                '90'        => $image,
                '360'       => $image,
                '420'       => $image,
            ],
            'title'     => $this->faker->name,
            'brand'     => $this->faker->company(),
            'body'      => $this->faker->text($maxNbChars = 1000),
            'color'     => $this->faker->hexcolor(),
            'size'      => $this->faker->randomElement($array = array ("'XXS'","'XS'","'S'","'M'","'l'","'xl'")),
            'price'     => $this->faker->numberBetween($min = 50, $max = 1000),
            'discount'  => $this->faker->numberBetween($min = 0, $max = 50),
            'count'     => $this->faker->numberBetween($min = 0, $max = 50),
            'status'    => $this->faker->boolean(),
            'top_offer' => $this->faker->boolean(),
            'sell_count' => $this->faker->numberBetween($min = 0, $max = 100),
        ];
    }

    protected function getPath()
    {
        $filePath = base_path('public/upload/loremPixel');
        if(!directoryExists($filePath)){
            mkdir($filePath);
        }

        return $filePath;
    }
}
