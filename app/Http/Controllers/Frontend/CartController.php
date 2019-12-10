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
        
        if( session()->has('cart') )
        {
            // var_dump($product->id);
            if ( array_key_exists($product->id,$cart['products'] ) )
            {
                // var_dump('here');
                $cart['products'][$product->id]['quantity'] += 1;
                $cart['products'][$product->id]['total_price'] =  $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price'] ;
            }
            else
            {
                array_push( $cart['products'], [
                    $product->id => [
                        'title'     =>  $product->title,
                        'quantity'  =>  1,
                        'unit_price' =>  $product->sale_price ?? $product->price
                    ]
                    ] );
            }
        }
        else
        {
            $cart['products'] = [
                $product->id => [
                    'title'     =>  $product->title,
                    'quantity'  =>  1,
                    'unit_price'  =>  $product->sale_price ?? $product->price
                ]
            ];
        }

        session(['cart'=>$cart]);

        session()->flash('message','Product Add Success');

        // dd( session()->get('cart') );

        return redirect()->route('cart.show');

//        dd(session('cart'));

    }

    function  showCart()
    {
        // session()->flush();
        $data = [];

        $data['cart'] = $cart = session()->get('cart.products') ?? [];

        // dd($cart);

        $data['total'] = array_sum( array_column( $cart , 'total_price' )  );

        // session()->put('product.total',$total);

        return view('frontend.cart.show',$data);

        // return redirect()->route('home');

    }

    function deleteFromCart(Request $request)
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

        session()->forget("products".$product['id'] );

    }

   
}
