<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function session;

class CartController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function addToCart(Request $request): RedirectResponse
    {
        try {
            $this->validate($request,
                [
                    'product_id' => 'required|numeric'
                ]);
        } catch (ValidationException $e) {
            return redirect()->back(404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back(400);
        }

        $product = $this->productRepository->findOrFail($request->input('product_id'));

        $cart = session()->get('cart') ?? [];

        if (session()->has('cart')) {
            if (array_key_exists($product->id, $cart['products'])) {
                $cart['products'][$product->id]['quantity'] += 1;
            } else {
                $cart['products'][$product->id] = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'quantity' => 1,
                    'unit_price' => $product->sale_price ?? $product->price
                ];
            }
        } else {
            $cart['products'][$product->id] = [
                'title' => $product->title,
                'slug' => $product->slug,
                'quantity' => 1,
                'unit_price' => $product->sale_price ?? $product->price
            ];
        }

        $cart['products'][$product->id]['total_price'] = $cart['products'][$product->id]['quantity'] * $cart['products'][$product->id]['unit_price'];

        session(['cart' => $cart]);

        session()->flash('message', 'Product Add Success');

        return redirect()->route('cart.show');

    }

    /**
     * @param false $flash
     * @return Application|Factory|View
     */
    function showCart(bool $flash = false)
    {
        if ($flash) {
            session()->flush();
        }
        $data = [];

        $data['cart'] = $cart = session()->get('cart.products') ?? [];

        $data['total'] = array_sum(array_column($cart, 'total_price'));

        return view('frontend.cart.show', $data);
    }

    function deleteFromCart(Request $request): RedirectResponse
    {
        try {
            $this->validate($request,
                [
                    'id' => 'required | numeric'
                ]);
        } catch (ValidationException $e) {
            return redirect()->back(404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back(400);
        }

        $product = $this->productRepository->findOrFail($request->input('id'));

        session()->forget("products" . $product['id']);
    }


}
