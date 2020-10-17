<?php
namespace App\Http\Controllers\Payment;

use SoapClient;

class Zarinpal extends PaymentInterface
{

    public function payment()
    {
        $checkout = auth()->user()->checkouts()->where('payment' , 0)->firstOrFail();
        $totalPrice = $this->getTotalPrice($checkout);

        if ($checkout->address == null || $checkout->name == null || $checkout->lastName == null || $checkout->phone == null || $checkout->postCode == null){
            return back()->with('message' , 'اطلاعات کافی نیست.');
        }

        $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required
        $Amount = $totalPrice;
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $CallbackURL = route('callback.payment','Zarinpal'); // Required

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

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
            $checkout->update([
                'resnumber' => $result->Authority,
            ]);

            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);

        } else {
            return 'ERR: '.$result->Status;
        }
    }

    public function checker()
    {
        $checkout = auth()->user()->checkouts()->where('payment' , 0)->firstOrFail();
        $totalPrice = $this->getTotalPrice($checkout);

        $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be';
        $Amount = $totalPrice;
        $Authority = request('Authority');

        if (request('Status') == 'OK') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

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

                echo 'Transaction success. RefID:'.$result->RefID;
            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }
}
