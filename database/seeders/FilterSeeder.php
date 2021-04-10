<?php

namespace Database\Seeders;

use App\Category;
use App\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     protected $value = [
         '5 x 5 x 0.7 inches; 10.4 Ounces',
         'Gildan',
         '60% Cotton',
         '40% Polyester',
         'Loose Fit',
     ];
    public function run()
    {
        Filter::truncate();
        Category::all()->map(function($category){
            $filter = Filter::factory([
                'category_id' => $category->id
            ])
                ->has(Filter::factory([
                    'category_id' => $category->id
                ])->count(random_int(2,6))
                ,'children')
            ->count(3)->create();

            $category->products->map(function($product) use($category) {
                foreach($category->filters->where('parent_id','!=',0) as $filter)
                {
                    $product->filters()->attach($filter->id, ['value' => collect($this->value)->random()]);
                }

            });

        });



    }
}
