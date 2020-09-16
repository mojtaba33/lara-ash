<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->paginate(9)->withQueryString();
        return view('default.category.category',compact('categories','products'));
    }

    public function single(Category $category)
    {
        $categories = Category::where('parent_id',0)->get();

        if ($category->parent_id == 0){
            $items = $category->getProducts();

            $currentPage = \request('page') != null ? \request('page') : 1 ;
            $perPage     = 9 ;

            $products = new LengthAwarePaginator($items->forPage($currentPage, $perPage) ,$items->count(),$perPage,$currentPage,[
                 'path' => route('category.single',$category),
                 'pageName' => 'page'
                ]);
        }else{
            $products = $category->products()->filter()->latest()->paginate(9)->withQueryString();
        }

        return view('default.category.category',compact('categories','products'));
    }
}
