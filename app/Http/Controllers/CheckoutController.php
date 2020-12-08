<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Http\Controllers\coupon\CouponTrait;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use CouponTrait;
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
        $checkout = auth()->user()->checkouts()->where('payment',0)->where('resnumber',null)->first();
        $carts = $checkout->carts()->get();
        $totalPrice = $this->getTotalPrice();
        return view('default.checkout.checkout',compact('checkout','carts','totalPrice'));
    }
}
