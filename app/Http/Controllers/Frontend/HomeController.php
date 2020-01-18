<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    function showHomePage()
    {
        $data=[];
        $products = Product::select(['id','slug','title','price','sale_price'])
                            ->where('active',1)
                            ->paginate(9);
        $data['products']= $products;

        return view('frontend.home',$data);
    }

    function about()
    {
        return view('frontend.about');
    }
}
