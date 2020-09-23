<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->favorites()->syncWithoutDetaching($product->id);

        return back()->with(['title'   => 'success','message' => 'done!','color'   => 'green']);
    }

    public function addAjax(Request $request)
    {
        if (!auth()->check()){
            return response(['title' => 'warning' , 'color' => 'yellow' , 'message' => 'login first']);
        }
        $product = Product::find($request->input('product_id'));

        auth()->user()->favorites()->syncWithoutDetaching($product->id);

        return response(['title'   => 'success','message' => 'done!','color'   => 'green']);
    }

    public function destroy(Product $product)
    {
        auth()->user()->favorites()->detach($product->id);
        return back();
    }
}
