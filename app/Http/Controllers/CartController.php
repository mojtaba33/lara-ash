<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Checkout;
use App\Http\Resources\CartCollection;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('default.cart.cart');
    }

    public function get()
    {
        if (!auth()->check() || ! auth()->user()->checkouts()->where('payment',0)->where('resnumber',null)->first() ){
            return response([
                'totalPrice' => 0,
                'totalCount' => 0,
            ]);
        }

        $checkout = auth()->user()->checkouts()->where('payment',0)->where('resnumber',null)->first();

        $carts = response([
            'data'       => new CartCollection( $checkout->carts()->get() ),
            'totalPrice' => $this->getTotalPrice( $checkout ),
            'totalCount' => $checkout->count,
        ]);

        return $carts;
    }

    public function delete(Request $request)
    {
        $cart_id = $request->input('id');
        $cart = Cart::find($cart_id);

        if ($cart->count > 1 ){
            $cart->decrement('count');
        }else{
            $cart->delete();
        }

        $cart->checkout->decrement('count');

    }

    public function add(Request $request)
    {
        if (!auth()->check()){
            return response(['title' => 'warning' , 'color' => 'yellow' , 'message' => 'login first']);
        }

        $product = Product::find($request->input('product_id'));
        $count   = $request->input('count');
        $color   = $request->input('color');
        $size    = $request->input('size');

        if ($count <= 0 || $color == null || $size == null )
        {
            return \response()->json(['title' => 'warning','message' => 'something went wrong!','color'=>'yellow']);
        }

        if($product->count < $count){
            return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
        }

        // Retrieve by payment and resnumber, or instantiate with the payment and count attributes...
        // find or create checkout model where payment = 0 , resnumber = null
        $checkout = auth()->user()->checkouts()->firstOrNew(
            ['payment' => 0 , 'resnumber' => null],
            ['count'   => 0]
        );
        $checkout->save();

        // find or create cart model product details
        $cart = $checkout->carts()->where('product_id',$product->id)
                ->where('color',$color)->where('size',$size)->firstOrNew([
                    /*'count'      => $count,*/
                    'color'      => $color,
                    'size'       => $size,
                    'product_id' => $product->id,
                ]);

        // check if quantity is more than inventory
        $productCount = Cart::where('checkout_id',$checkout->id)->where('product_id',$product->id)->sum('count');
        if($product->count < $count + $productCount){
            return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
        }
        // create cart and increase quantity
        $cart->save();
        $checkout->increment('count',$count);
        $cart->increment('count',$count);

        return response(['title'   => 'success','message' => 'done!','color'   => 'green']);
    }

    public function update(Request $request)
    {
        $cart_id = $request->input('params.id');
        $count   = $request->input('params.count');

        $cart = Cart::find($cart_id);

        $totalProductCount = $cart->checkout->carts()->where('product_id',$cart->product_id)->pluck('count')->sum();

        if($cart->product->count < $count + $totalProductCount){
            return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
        }

        $cart->increment('count',$count);
        $cart->checkout->increment('count',$count);
    }

    public function getTotalPrice(Checkout $checkout)
    {
        $carts      = $checkout->carts()->get() ;
        $totalPrice = 0 ;

        foreach ($carts as $cart)
        {
            $totalPrice += Product::find($cart->product_id)->getPrice() * $cart->count;
        }

        return $totalPrice;
    }

}
