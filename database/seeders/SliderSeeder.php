<?php

namespace Database\Seeders;

use App\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::truncate();

        Slider::factory()->count(3)->create();
    }
}
