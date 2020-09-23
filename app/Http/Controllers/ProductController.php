<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single(Product $product)
    {
        $relatedProducts = Product::where(function ($query) use($product) {
            $query->where('brand',$product->brand)
                ->orWhere('category_id',$product->category_id);
            })
            ->where('id' , '!=' ,$product->id)
            ->take(4)->latest()->get();

        $comments = $product->comments()
            ->where('approved',1)
            ->where('parent_id',0)
            ->latest()
            ->paginate(20)->withQueryString();

        //dd($product->comments);
        return view('default.product.single',compact('product','comments','relatedProducts'));
    }
}
