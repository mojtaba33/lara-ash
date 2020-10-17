<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Payment\PaymentInterface;

class PaymentController extends Controller
{
    public function payment(PaymentInterface $payment)
    {
        return $payment->payment();
    }

    public function checker(PaymentInterface $payment)
    {
        return $payment->checker();
    }
}
