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
                                <img class="card card-img-top" src="{{  $product->getFirstMediaUrl('products') }}" alt="{{$product->title}}">
{{--                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>--}}
                                <div class="card-body">
                                    <p class="card-text">{{ $product->title }}</p>
                                    <div class="d-flex justify-content-be
                                    tween align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View Details</button>
                                        </div>
                                        <strong class="text-muted">BDT {{ $product->price }}</strong>
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


