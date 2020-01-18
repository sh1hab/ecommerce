@extends('frontend.layouts.master')

@section('content')
    <div class="container" id="app">
        <br>
        <p class="text-center">{{ $product->title }}</p>
        <hr>

        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <article class="gallery-wrap">
                        <div>
                            <img src="{{ $product->getFirstMediaUrl('products') }}" class="card-img-top" alt="{{ $product->title }}">
                        </div> <!-- slider-product.// -->
                    </article> <!-- gallery-wrap .end// -->
                </aside>

                <aside class="col-sm-7">
                    <article class="card-body p-5">
                        <h3 class="title mb-3">{{ $product->title }}</h3>

                        <p class="price-detail-wrap">
                            <span class="price h3 text-warning">
                                {{-- <span class="currency">BDT </span> --}}
                                <span class="num">
                                    @if($product->sale_price !== null && $product->sale_price > 0)
                                        BDT <strike>{{ $product->price }}</strike> BDT {{ $product->sale_price }}
                                    @else
                                        BDT{{ $product->price }}
                                    @endif
                                </span>
                            </span>
                        </p> <!-- price-detail-wrap .// -->

                        <dl class="item-property">
                            <dt>Description</dt>
                            <dd><p>{{ $product->description }}</p></dd>
                        </dl>

                        <hr>

                        <form action="{{ route('cart.add') }}" id="addToCart" method="post" v-on:submit.prevent="addToCart">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="submit" class="btn btn-lg btn-outline-secondary" @click.prevent="addToCart" value="Add to cart">
                                <!-- <i class="fas fa-shopping-cart"></i> Add to Cart -->
                            
                        </form>

                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->

    </div>
    <!--container.//-->

@endsection

@section("js")


    <script type="text/javascript">

        let app = new Vue({
            el:'app',
            data:{},
            methods:{
                addToCart(){
                    alert('worked');
                }
            },
            mounted(){
                // alert('mounted');
            }
        });
    </script>

@stop
