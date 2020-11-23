<?php

namespace Database\Factories;

use App\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'url' => $this->faker->url,
            'image' => 'upload/faker/blog.jpg',
            'description' => $this->faker->text($maxNbChars = 100),
            'show' => true,
        ];
    }
}
