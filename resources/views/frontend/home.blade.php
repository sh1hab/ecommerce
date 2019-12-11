@extends('frontend.layouts.master')

@section('content')
    <main role="main">

        @include('frontend.partials.hero')

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    @foreach( $products as $product )
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <a href="{{ route('product.details',$product->slug)  }}"><img class="card card-img-top" src="{{  $product->getFirstMediaUrl('products') }}" alt="{{$product->title}}"></a>

                                <div class="card-body">
                                    <p class="card-text"><a href="{{ route('product.details',$product->slug)  }}">{{ $product->title }}</a></p>
                                    <div class="d-flex justify-content-be
                                    tween align-items-center">
{{--                                        <div class="btn-group">--}}
{{--                                            <button type="button" class="btn btn-sm btn-outline-secondary">Add to cart</button>--}}
{{--                                            <button type="button" class="btn btn-sm btn-outline-secondary">View Details</button>--}}
{{--                                        </div>--}}
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="btn-group">
                                            <button type="submit" class="btn btn-lg btn-outline-secondary">
                                                <i class="fas fa-shopping-cart"></i> Add to Cart
                                            </button>
                                            </div>
                                        </form>
                                        <strong class="text-muted">BDT {{ $product->sale_price ?? $product->price }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>

    </main>
@stop


