<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    protected $paginate = 10;

    public function __invoke(): Renderable
    {
        $data=[];
        $products = Product::select(['id','slug','title','price','sale_price'])
            ->where('active',1)
            ->paginate($this->paginate);
        $data['products'] = $products;

        return view('frontend.home',$data);
    }

//    function showHomePage()
//    {
//        $data=[];
//        $products = Product::select(['id','slug','title','price','sale_price'])
//                            ->where('active',1)
//                            ->paginate(9);
//        $data['products'] = $products;
//
//        return view('frontend.home',$data);
//    }
//
//    function about()
//    {
//        return view('frontend.about');
//    }
}
