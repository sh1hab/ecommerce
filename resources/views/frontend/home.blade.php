@extends('frontend.layouts.master')

@section('content')
    <main role="main">

        @include('frontend.partials.hero')

        <div class="album py-5 bg-light" id="products">
            <div class="container">

                <div class="row">
                    @foreach( $products as $product )
                        <product id="{{ $product->id }}"
                                 image="{{ $product->getFirstMediaUrl('products') }}"
                                 slug="{{$product->slug}}"
                                 price="{{ $product->sale_price ?? $product->price }}"
                                 title="{{ $product->title }}"
                        >

                        </product>

                    @endforeach

                    <div class="text-center">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>

    </main>
@stop

@section('js')

    <script type="text/javascript">

        Vue.component('product', {
            props: ['id', 'title', 'image', 'slug', 'price'],

            template:
                `
                    <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <a :href="'product/'+slug "><img class="card card-img-top" :src="  image " :alt=" title "></a>

                                <div class="card-body">
                                    <p class="card-text"><a :href="'product/'+slug">@{{ title }}</a></p>
                                    <div class="d-flex justify-content-be
                                    tween align-items-center">

                <form action="" method="post">
                                            @csrf
                <input type="hidden" name="product_id" :value="id ">
                                            <div class="btn-group">
                                            <button @click="$emit('addToCart')" type="submit" class="btn btn-lg btn-outline-secondary">
                                                <i class="fas fa-shopping-cart"></i> Add to Cart
                                            </button>
                                            </div>
                                        </form>
                                        <strong class="text-muted">BDT @{{ price }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
`
        });

        let cart = new Vue({
            "el": '#products',
            "data": {},
            "methods": {
                "fetchProductImage": function () {
                    // axios.get()
                },
                "deleteSession": function () {

                }
            },
            "mounted"() {
                this.isLoading = true;
            },
            "computed": {

                showBdt() {
                    // return this.
                }

            }
        });

    </script>

@stop



