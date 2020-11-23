<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ServiceSeeder::class);
    }
}
