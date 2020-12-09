<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Http\Controllers\coupon\CouponTrait;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use CouponTrait;

    public function checkCoupon(Request $request)
    {
        $code = $request->input('code');
        $coupon = Coupon::where('code',$code)->first();

        if ( ! $coupon || $coupon->is_expired())
        {
            return \response()->json(['message' => 'the code is incorrect!'],404);
        }

        auth()->user()->coupons()->syncWithoutDetaching($coupon->id);

        if(auth()->user()->coupons()->find($coupon)->pivot->is_used == 1)
        {
            return \response()->json(['message' => 'you have used this code before!'],404);
        }

        $checkout = auth()->user()->checkouts()->where('payment',0)->where('resnumber',null)->first();

        return \response()->json([
            'message'  => 'coupon applied',
            'oldPrice' => $this->getTotalPriceWithoutCoupon($checkout),
            'newPrice' => $this->getTotalPrice($checkout),
        ]);
    }
}
