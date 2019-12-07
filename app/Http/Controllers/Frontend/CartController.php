<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
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

        if( session()->has('cart') )
        {
            if ( array_key_exists($product->id,$cart) )
            {
                $cart['products'][$product->id]['quantity'] += 1;
            }else{
                $cart['products'] = [
                    $product->id => [
                        'title'     =>  $product->title,
                        'quantity'  =>  1,
                        'price'     =>  $product->sale_price ?? $product->price
                    ]
                ];
            }
        }else{
            $cart['products'] = [
                $product->id => [
                    'title'     =>  $product->title,
                    'quantity'  =>  1,
                    'price'     =>  $product->sale_price ?? $product->price
                ]
            ];
        }

        session(['cart'=>$cart]);

        return redirect()->route('home');

//        dd(session('cart'));

    }

    function  showCart()
    {

    }
}
