<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Checkout;
use App\Http\Resources\CartCollection;
use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use SoapClient;

class CartController extends Controller
{


    public function index()
    {
        //$cart = auth()->user()->carts()->where('payment',0)->first();
        return view('default.cart.cart');
    }

    public function get()
    {
        if (!auth()->check() || !auth()->user()->checkouts()->pluck('payment')->contains(0)){
            return response([
                'fullPrice' => 0,
                'fullCount' => 0,
            ]);
        }

        $checkout = auth()->user()->checkouts()->where('payment',0)->first();
        $carts = response([
            'data'      => new CartCollection( $checkout->carts()->get() ),
            'totalPrice' => $this->getTotalPrice( $checkout ),
            'totalCount' => $checkout->count,
        ]);

        return $carts;
    }

    public function delete(Request $request)
    {
        $cart_id = $request->input('id');
        $cart = Cart::find($cart_id);

        if ($cart->count > 1 ){
            $cart->decrement('count');
        }else{
            $cart->delete();
        }

        $cart->checkout->decrement('count');

    }

    public function add(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $count   = $request->input('count');
        $color   = $request->input('color');
        $size    = $request->input('size');

        if ($count <= 0 || $color == null || $size == null )
        {
            return \response()->json(['title' => 'warning','message' => 'something went wrong!','color'=>'yellow']);
        }

        if (!auth()->check()){
            return response(['title' => 'warning' , 'color' => 'yellow' , 'message' => 'login first']);
        }

        if (!auth()->user()->checkouts()->pluck('payment')->contains(0)){ //if checkout not exist
            //return $count;
            if($product->count < $count){
                return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
            }

            auth()->user()->checkouts()->create([
                'price' => null /*$this->getPrice($product) * $count*/,
                'count' => $count,
            ])->carts()->create([
                'count' => $count,
                'color' => $color,
                'size'  => $size,
                'product_id' => $product->id,
            ]);

            return response(['title'   => 'success','message' => 'done!','color'   => 'green']);


        }else{
            $checkout_id = auth()->user()->checkouts()->where('payment',0)->first()->id;
            if(
                Cart::where('checkout_id',$checkout_id)->where('product_id',$product->id)
                ->where('color',$color)->where('size',$size)->first()
            ){
                $productCount = Cart::where('checkout_id',$checkout_id)->where('product_id',$product->id)->sum('count');

                if($product->count < $count + $productCount){
                    return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
                }
                // increment count & price pivot
                Cart::where('checkout_id',$checkout_id)
                    ->where('product_id',$product->id)->where('color',$color)->where('size',$size)
                    ->increment('count',$count);

                auth()->user()->checkouts()->where('payment',0)->increment('count',$count);

                /*$newCount = Cart::where('checkout_id',$checkout_id)
                    ->where('product_id',$product->id)->where('color',$color)->where('size',$size)
                    ->first()->count;

                Cart::where('checkout_id',$checkout_id)->where('product_id',$product->id)
                    ->where('color',$color)->where('size',$size)
                    ->update([
                    'price' => $this->getPrice($product) * $newCount,
                ]);*/
                // increment count & price cart

                // $this->changeCartPrices();

                return response(['title'   => 'success','message' => 'done!','color'   => 'green']);

            }else{
                $productCount = Cart::where('checkout_id',$checkout_id)->where('product_id',$product->id)->sum('count');
                if($product->count < $count + $productCount){
                    return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
                }
                // create pivot
                auth()->user()->checkouts()->where('payment',0)->first()->carts()->create([
                    'count'      => $count,
                    'color'      => $color,
                    'size'       => $size,
                    'product_id' => $product->id,
                ]);

                auth()->user()->checkouts()->where('payment',0)->increment('count',$count);

                // change count & price cart
                //$this->changeCartPrices();

                return response(['title'   => 'success','message' => 'done!','color'   => 'green']);

            }
        }
    }

    public function update(Request $request)
    {
        $cart_id = $request->input('params.id');
        $count   = $request->input('params.count');

        $cart = Cart::find($cart_id);

        $totalProductCount = $cart->checkout->carts()->where('product_id',$cart->product_id)->pluck('count')->sum();

        if($cart->product->count < $count + $totalProductCount){
            return response(['title'   => 'warning','message' => 'The quantity is more than inventory!','color'   => 'yellow']);
        }

        $cart->increment('count',$count);
        $cart->checkout->increment('count',$count);
    }

    //protected $totalPrice = 0 ;

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

    /*public function getPrice(Product $product)
    {
        if ($product->discount == 0){
            return $product->price;
        }

        return $product->price - ($product->discount * $product->price) / 100 ;

    }*/


    /*public function changeCartPrices(): void
    {
        $checkout_id = auth()->user()->checkouts()->where('payment',0)->first()->id;
        auth()->user()->checkouts()->where('payment', 0)->update([
            'price' => DB::table('cart_product')->where('cart_id', $checkout_id)->sum('price'),
            'count' => DB::table('cart_product')->where('cart_id', $checkout_id)->sum('count'),
        ]);
    }*/

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

    public function checkout()
    {
        $checkout = auth()->user()->checkouts()->where('payment',0)->first();
        $carts = $checkout->carts()->get();
        $totalPrice = $this->getTotalPrice($checkout);
        return view('default.checkout.checkout',compact('checkout','carts','totalPrice'));
    }

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
        $CallbackURL = url('payment/checker'); // Required


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
            echo'ERR: '.$result->Status;
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
