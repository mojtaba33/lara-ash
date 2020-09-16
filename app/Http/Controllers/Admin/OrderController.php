<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::where('payment' , 1)->latest()->paginate(20);
        return view('admin.order.index',compact('orders'));
    }

    public function delivered()
    {
        $orders = Checkout::where('payment' , 1)->where('deliver',1)->latest()->paginate(20);
        return view('admin.order.delivered',compact('orders'));
    }

    public function undelivered()
    {
        $orders = Checkout::where('payment' , 1)->where('deliver',0)->latest()->paginate(20);
        return view('admin.order.undelivered',compact('orders'));
    }

    public function single(Checkout $checkout)
    {
        $carts = $checkout->carts()->latest('count')->get();
        return view('admin.order.single',compact('checkout','carts'));
    }

    public function deliver(Checkout $checkout)
    {
        $checkout->update([
            'deliver' => 1,
        ]);

        return back()->with('message' , 'عملیات با موفقیت انجام شد.');
    }
}
