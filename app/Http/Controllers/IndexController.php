<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Http\Controllers\Admin\ServiceController;
use App\Product;
use App\Service;
use App\Slider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $leftBanner = Banner::where('show',1)->where('position' , 'left')->first();
        $rightBanners = Banner::where('show',1)->where('position' , 'right')->take(4)->get();

        $categories = Category::latest()->has('products', '>=', 4)->where('parent_id','<>',0)->take(4)->get();
        $topOfferProducts = Product::where('top_offer',1)->latest()->get();

        $hotTrendProducts = Product::latest('rate')->take(3)->get();
        $bestSellerProducts = Product::latest('sell_count')->take(3)->get();
        $features = Product::where('top_offer',1)->latest()->take(3)->get();

        $services = Service::take(4)->get();

        $sliders = Slider::all();
        return view('default.index',compact(
            'leftBanner','rightBanners',
            'sliders','categories','hotTrendProducts',
            'bestSellerProducts','topOfferProducts','features','services'
        ));
    }

    public function search(Request $request)
    {
        $item = $request->input('item');

        $products = Product::where('title','like','%'. $item .'%')->latest()->take(3)->get();

        $categories = Category::where('title','like','%'. $item .'%')->latest()->take(3)->get();

        $products->isNotEmpty() ? $res ="<tr><td colspan='2' style='background-color: #eee;color: dodgerblue;'>products</td></tr>" : $res ="" ;

        foreach ($products as $product)
        {
            $res .=  "
                    <tr >
                        <td class='align-middle'><img height='50' src=".url($product->image[90])."></td>
                        <td class='align-middle'><a style='color: #fff' href='{$product->path()}'>{$product->title}</a></td>
                    </tr>";
        }

        $categories->isNotEmpty() ? $res .="<tr><td colspan='2' style='background-color: #eee;color: dodgerblue;'>categories</td></tr>" : $res .="" ;

        foreach ($categories as $category)
        {
            $res .=  "<tr >
                        <td class='align-middle' colspan='2'><a style='color: #fff' href='{$category->path()}'>{$category->title}</a></td>
                      </tr>";
        }

        return $res;
    }
}
