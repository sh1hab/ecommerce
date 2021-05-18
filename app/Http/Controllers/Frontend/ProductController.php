<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function showDetails(Request $request, $slug)
    {
        $product = $this->productRepository->where('slug', $slug)
            ->where('active', 1)
            ->first();

        if (is_null($product)) {
            return redirect()->route('');
        }
        $data['product'] = $product;

        return view('frontend.products.details', $data);
    }
}
