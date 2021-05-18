<?php

namespace Database\Factories;

use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    protected $ip = [
        '127.0.0.1',
        '127.0.0.2',
        '127.0.0.3',
        '127.0.0.4',
        '127.0.0.5',
        '127.0.0.6',
        '127.0.0.7',
        '127.0.0.8',
    ];
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => collect($this->ip)->random(),
            'user_id' => User::all()->random()->id,
            'route' => '/',
        ];
    }
}
