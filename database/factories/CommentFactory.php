<?php

namespace Database\Factories;

use App\Comment;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mockery\Generator\StringManipulation\Pass\ClassNamePass;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate' => random_int(1,5) ,
            'body' => $this->faker->paragraph(),
            //'commentable_type' => class_basename(Product::class),
            'user_id' => User::all()->random(),
            'parent_id' => 0 ,
            'approved' => 1
        ];
    }
}
