<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\coupon\CouponTrait;
use App\Notifications\Paid;
use Illuminate\Support\Facades\Notification;
use SoapClient;

class Zarinpal extends PaymentInterface
{
    public function payment()
    {
        $checkout = auth()->user()->checkouts()->where('payment' , 0)->where('resnumber',null)->firstOrFail();
        $totalPrice = $this->getTotalPrice($checkout);

        if ($checkout->address == null || $checkout->name == null || $checkout->lastName == null || $checkout->phone == null || $checkout->postCode == null){
            return back()->with('message' , 'اطلاعات کافی نیست.');
        }

        $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required
        $Amount = $totalPrice;
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $CallbackURL = route('callback.payment','Zarinpal'); // Required

        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'CallbackURL' => $CallbackURL,
            ]
        );

        if ($result->Status == 100) {
            return redirect('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);

        } else {
            return 'ERR: '.$result->Status;
        }
    }

    public function checker()
    {
        $Authority = request('Authority');

        $checkout = auth()->user()->checkouts()->where('payment' , 0)->where('resnumber',null)->firstOrFail();
        $totalPrice = $this->getTotalPrice($checkout);

        $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be';
        $Amount = $totalPrice;


        if (request('Status') == 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                $checkout->update([
                    'payment' => 1 ,
                    'price' => $totalPrice ,
                ]);

                Notification::send(auth()->user() , new Paid($checkout,$result->RefID));

                $coupon = auth()->user()->unusedCoupons()->latest()->first();
                if($coupon)
                {
                    $coupon->is_used = 1;
                }

                $checkout->update([
                    'resnumber' => $result->RefID,
                ]);
                return view('default.checkout.status',['ref_id'=>$result->RefID], ['price'=>$totalPrice]);
            } else {
                $checkout->update([
                    'resnumber' => $result->Status,
                ]);
                return view('default.checkout.status',['ref_id'=>$result->RefID], ['price'=>$totalPrice]);
            }
        } else {
            return redirect(route('cart.index'));
        }
    }
}
