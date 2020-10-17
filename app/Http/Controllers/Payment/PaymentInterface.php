<?php


namespace App\Http\Controllers\Payment;


use App\Checkout;
use App\Product;

abstract class PaymentInterface
{
    abstract public function payment();
    abstract public function checker();

    protected function getTotalPrice(Checkout $checkout)
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
