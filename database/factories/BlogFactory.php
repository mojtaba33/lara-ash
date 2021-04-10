<?php

namespace Database\Factories;

use App\Blog;
use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;
    protected $image = [
        'upload/faker/blog/blog-2.jpg',
        'upload/faker/blog/blog-3.jpg',
        'upload/faker/blog/blog-4.jpg',
        'upload/faker/blog/blog-5.jpg',
        'upload/faker/blog/blog-7.jpg',
        'upload/faker/blog/blog-8.jpg',
        'upload/faker/blog/blog-9.jpg',
        'upload/faker/blog/blog-10.jpg',
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
            'category_id' => Category::all()->random(),
            'user_id'     => User::factory(),
            'image'       => $image,
            'title'       => $this->faker->name,
            'body'        => $this->faker->text($maxNbChars = 1000),
            'tags'        => implode(',',$this->faker->words($nb = 3, $asText = false))
        ];
    }
}
