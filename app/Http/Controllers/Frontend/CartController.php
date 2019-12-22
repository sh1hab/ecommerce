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
            if ( array_key_exists($product->id,$cart['products'] ) )
            {
                $cart['products'][$product->id]['quantity'] += 1;
//                $cart['products'][$product->id]['total_price'] =  $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price'] ;
            }
            else
            {
                $cart['products'][  $product->id ] = [
                    'title'         =>  $product->title,
                    'slug'          =>  $product->slug,
                    'quantity'      =>  1,
                    'unit_price'    =>  $product->sale_price ?? $product->price
//                    'total_price'  => $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price']
                ];
            }

//            $cart['products'][$product->id]['total_price'] =  $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price'] ;
        }
        else
        {
            $cart['products'][  $product->id ] = [
                'title'         =>  $product->title,
                'slug'          =>  $product->slug,
                'quantity'      =>  1,
                'unit_price'    =>  $product->sale_price ?? $product->price
//                'total_price'  => $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price']
            ];

        }

        $cart['products'][$product->id]['total_price'] =  $cart['products'][$product->id]['quantity'] *  $cart['products'][$product->id]['unit_price'] ;

        session(['cart'=>$cart]);

        session()->flash('message','Product Add Success');

        return redirect()->route('cart.show');

    }

    function  showCart($flash=false)
    {
        if ( $flash )
        {
            \session()->flush();
        }
        $data = [];

        $data['cart'] = $cart = session()->get('cart.products') ?? [];

        $data['total'] = array_sum( array_column( $cart , 'total_price' )  );

        return view('frontend.cart.show',$data);
    }

    function deleteFromCart(Request $request)
    {
        try{
            $this->validate($request,
                [
                    'id' =>'required|numeric'
                ]);
        }catch (ValidationException $e){
            return redirect()->back(404);
        }

        $product = Product::findOrFail( $request->input('id') );

        session()->forget("products".$product['id'] );
    }


}
