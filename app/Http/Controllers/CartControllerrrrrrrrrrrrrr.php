<?php

namespace App\Http\Controllers;

use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product,Request $request)
    {
        if ($request->input('count') <= 0 || $request->input('color') == null || $request->input('size') == null )
        {
            return \response()->json(['title' => 'warning','message' => 'something went wrong!','color'=>'yellow']);
        }

        if ( !$request->session()->has('cart') )
        {

            $this->createCartSession([
                'data' => [
                    $product->id => [
                        'product_id' => $product->id,
                        'count'      => $request->input('count'),
                        'image'      => url($product->image[90]),
                        'title'      => $product->title,
                        'brand'      => $product->brand,
                        'url'        => url($product->slug),
                        'category'   => $product->category->title,
                        'price'      => $product->getPrice() * $request->input('count'),
                        'color'      => $request->input('color'),
                        'size'       => $request->input('size'),
                    ]
                ],
                'totalCount' => $request->input('count'),
                'totalPrice' => $product->getPrice() * $request->input('count'),
            ]);
            //return 'سشنی وجود نداره';
        }else{
            if ( !$request->session()->has('cart.data.'.$product->id ) )
            {
                //return 'محصول وجود نداره';
                $this->updateCartSession($product);
            }else{

                if(
                    $request->session()->get('cart.data.'.$product->id.'.color') == $request->input('color') &&
                    $request->session()->get('cart.data.'.$product->id.'.size') == $request->input('size')
                    )
                {
                    /*return 'رنگ یا سایز وجود داره'
                        . $request->session()->get('cart.data.'.$product->id.'.color')
                        . $request->input('color')
                        . $request->session()->get('cart.data.'.$product->id.'.size')
                        . $request->input('size');*/
                    $this->newTotal($product);

                    $count    = $request->session()->get('cart.data.'.$product->id.'.count');
                    $newCount = $count + $request->input('count');

                    $price    = $request->session()->get('cart.data.'.$product->id.'.price');
                    $newPrice = $price + $request->input('count') * $product->getPrice();

                    $change = [
                        'cart.data.'.$product->id.'.count' => $newCount,
                        'cart.data.'.$product->id.'.price' => $newPrice,
                    ];

                    $this->changeCartSessionItem($change);

                }else{
                    //return 'رنگ یا سایز وجود نداره';
                    $this->updateCartSession($product);
                }

            }

        }

        return \response()->json([
            'title'   => 'success',
            'message' => 'done!',
            'color'   => 'green'
        ]);
    }

    private function updateCartSession(Product $product)
    {
        $cart = \request()->session()->get('cart');

        $cart['data'][$product->id] =[
            'product_id' => $product->id,
            'count'      => \request()->input('count'),
            'image'      => url($product->image[90]),
            'title'      => $product->title,
            'brand'      => $product->brand,
            'url'        => url($product->slug),
            'category'   => $product->category->title,
            'price'      => $product->getPrice() * \request()->input('count'),
            'color'      => \request()->input('color'),
            'size'       => \request()->input('size'),
        ];

        $this->newTotal($product);

        return $cart;

        $this->createCartSession($cart);

    }

    private function createCartSession(array $cart)
    {
        session([
            'cart' => $cart
        ]);
    }

    private function changeCartSessionItem(array $items)
    {
        foreach($items as $key=>$value)
        {
            \request()->session()->put($key, $value);
        }
    }

    public function get()
    {
        $carts = session()->get('cart');
        return \response()->json($carts);
    }

    private function newTotal(Product $product): void
    {
        $total = [
            'totalCount' , 'totalPrice'
        ];

        foreach ($total as $value)
        {
            $getTotal = \request()->session()->get('cart.'.$value);
            if ($value == 'totalCount')
            {
                $newTotal = $getTotal + \request()->input('count');
            }else if($value == 'totalPrice'){
                $newTotal = $getTotal + $product->getPrice() * \request()->input('count');
            }
            \request()->session()->put('cart.'.$value, $newTotal);
        }
    }
}
