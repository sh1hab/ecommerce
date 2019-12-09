<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function addToCart(Request $request)
    {
        try{
            $this->validate($request,
                [
                    'product_id' =>'required|numeric'
                ]);
        }catch (ValidationException $e){
            return redirect()->back(404);
        }

        $product = Product::findOrFail( $request->input('product_id') );

        $cart = session()->get('cart') ?? [];
        //dd($cart);
        if( session()->has('cart') )
        {
            var_dump($product->id);
            if ( array_key_exists($product->id,$cart['products'] ) )
            {
                var_dump('here');
                $cart['products'][$product->id]['quantity'] += 1;
            }
            else{
                array_push( $cart['products'], [
                    $product->id => [
                        'title'     =>  $product->title,
                        'quantity'  =>  1,
                        'price'     =>  $product->sale_price ?? $product->price
                    ]
                    ] );
            }
        }else{
//            var_dump('new cart');
            $cart['products'] = [
                $product->id => [
                    'title'     =>  $product->title,
                    'quantity'  =>  1,
                    'price'     =>  $product->sale_price ?? $product->price
                ]
            ];
        }

        session(['cart'=>$cart]);

        dd( session()->get('cart') );

        return redirect()->route('home');

//        dd(session('cart'));

    }

    function  showCart()
    {
        session()->flush();

        return redirect()->route('home');

    }
}
