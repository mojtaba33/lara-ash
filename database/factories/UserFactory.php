<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween($min = 7, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 3),
        'image' => [
            'original'  => $faker->imageUrl(700, 800, 'fashion'),
            '90'        => $faker->imageUrl(90, 90, 'fashion'),
            '360'       => $faker->imageUrl(260, 360, 'fashion'),
            '420'       => $faker->imageUrl(420, 550, 'fashion'),
        ],
        'title'     => $faker->word(),
        //'slug' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'brand'     => $faker->company(),
        'body'      => $faker->text($maxNbChars = 1000),
        'color'     => $faker->hexcolor(),
        'size'      => $faker->randomElement($array = array ("'XXS'","'XS'","'S'","'M'","'l'","'xl'")),
        'price'     => $faker->numberBetween($min = 50, $max = 1000),
        'discount'  => $faker->numberBetween($min = 0, $max = 50),
        'count'     => $faker->numberBetween($min = 0, $max = 50),
        'status'    => $faker->boolean(),
        'top_offer' => $faker->boolean(),
        'sell_count' => $faker->numberBetween($min = 0, $max = 100),
    ];
    /*'' , '' , '','','',
        '','','','','',
        '','','rate','status','top_offer','sell_count',*/
});
