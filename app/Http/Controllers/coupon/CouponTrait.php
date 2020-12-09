<?php
namespace App\Http\Controllers\coupon;


use App\Checkout;
use App\Product;

trait CouponTrait
{
    public function getTotalPrice(Checkout $checkout)
    {
        $carts      = $checkout->carts()->get() ;
        $totalPrice = 0 ;
        $coupon = auth()->user()->unusedCoupons()->latest()->first();

        foreach ($carts as $cart)
        {
            $product = Product::find($cart->product_id);
            if ($coupon)
            {
                if ($coupon->hasCategory( $product->category) )
                {
                    $totalPrice += ($product->getPrice() * ( (100 - $coupon->value) / 100 )) * $cart->count;
                    continue;
                }
            }
            $totalPrice += $product->getPrice() * $cart->count;
        }

        return $totalPrice;
    }

    public function getTotalPriceWithoutCoupon(Checkout $checkout)
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