<?php


namespace App\Http\Controllers\Payment;


use App\Checkout;
use App\Http\Controllers\coupon\CouponTrait;
use App\Product;

abstract class PaymentInterface
{
    use CouponTrait;
    abstract public function payment();
    abstract public function checker();
}
