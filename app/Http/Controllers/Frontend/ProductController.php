<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function showDetails($slug)
    {
        $data=[];
        $product = Product::where('slug',$slug)
                ->where('active',1)
                ->first();

        if( is_null($product) )
        {
            return redirect()->route('');
        }
        $data['product'] = $product;

        return view('frontend.products.details',$data);
    }
}
