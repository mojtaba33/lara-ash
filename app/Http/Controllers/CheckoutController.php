<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function address(Checkout $checkout , Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'postCode' => 'required|numeric',
        ]);

        $checkout->update([
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'postCode' => $request->input('postCode'),
        ]);

        return back()->with('message' , 'Your information has been successfully registered.');
    }

    public function index()
    {
        $checkout = auth()->user()->checkouts()->where('payment',0)->first();
        $carts = $checkout->carts()->get();
        $totalPrice = $this->getTotalPrice($checkout);
        return view('default.checkout.checkout',compact('checkout','carts','totalPrice'));
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
