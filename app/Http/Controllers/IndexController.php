<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $leftCategory = Category::where('parent_id',0)->where('show',1)->where('position' , 'left')->first();
        $rightCategories = Category::where('parent_id',0)->where('show',1)->where('position' , 'right')->take(4)->get();

        $categories = Category::where('parent_id',0)->get();

        $newProducts = Product::latest()->take(8)->get();
        $hotTrendProducts = Product::latest('rate')->take(3)->get();
        $bestSellerProducts = Product::latest('sell_count')->take(3)->get();
        $topOfferProducts = Product::where('top_offer',1)->latest()->take(3)->get();

        $sliders = Slider::all();
        return view('default.index',compact(
            'leftCategory','rightCategories',
            'sliders','categories','newProducts','hotTrendProducts',
            'bestSellerProducts','topOfferProducts'
        ));
    }
}
