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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
            'image'       => 'upload/faker/blog.jpg',
            'title'       => $this->faker->name,
            'body'        => $this->faker->text($maxNbChars = 1000),
            'tags'        => implode($this->faker->words($nb = 3, $asText = false),',')
        ];
    }
}
