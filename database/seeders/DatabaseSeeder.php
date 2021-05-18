<?php
namespace Database\Seeders;
use App\Blog;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UserSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(FilterSeeder::class);
        $this->call(VisitSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
