    @extends('frontend.layouts.master')

    @section('content')
        <style>
            .hide{
                display: none !important;
            }
        </style>

        <div class="container" id="cart">

            <modal showModalForDelete="false" v-if="showModalForDelete" @close="showModalForDelete = false">
                Are you sure want to delete this product ?
            </modal>

            <!-- <div class="spinner-border " :class="{ 'hide':isLoading }"></div> -->

            <br>

            <p class="text-center">Cart<p>
            <hr>

            @if( session()->has('message') )
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Serial</td>
                        <td>Product</td>
                        <td>Unit Price</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    @php $i=1; @endphp
                    @foreach ($cart as $key => $items)
                        <tr>
                                <td>{{ $i++ }}</td>
                                <td v-on:mouseover="fetchProductImage"><a target="_blank" href=" {{ route('product.details',$items['slug']) }} ">{{ $items['title'] }}</a> </td>
                                <td>{{ number_format($items['unit_price'],2) }}</td>
                                <td><label>
                                        <input type="number" value="{{ $items['quantity'] }}">
                                    </label>
                                </td>
                                <td>{{ number_format( $items['total_price'],2 ) }}</td>
                                <td>
                                    <form action="{{ route('cart.delete') }}" method="post" >
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">

                                        <input type="submit" class="btn-sm btn-danger" value="Remove" v-on:click.prevent="showModal">
                                    </form>
                                </td>
                        </tr>
                    @endforeach

                    <tr>
                            <td></td>
                            <td> </td>
                            <td></td>
                            <td>Total:</td>
                            <td></td>
                    </tr>
                    <?php //print json_encode($cart)   ?>
                </tbody>
            </table>
        </div>

    @stop

    @section('js')

        <script type="text/javascript">

            Vue.component('modal',{
                props:['showModalForDelete'],

                template:
                `<div class="modal"  tabindex="-1" role="dialog" style="display:block">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('close')">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <p><slot></slot></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">No</button>
                    </div>
                    </div>
                </div>
            </div>`

            });

            let cart = new Vue({
                "el": '#cart',
                "data": {
                    "isLoading":false,
                    "total": 0,
                    "cart": "",
                    "showModalForDelete":false
                },
                methods: {

                    "showModal":function(){
                        // alert('here');
                        this.showModalForDelete = true;
                    },

                    "fetchProductImage": function () {
                        // axios.get()
                    },

                    "deleteSession":function () {

                    }
                },
                "mounted"(){
                    this.isLoading = true;
                    // alert(false);
                },
                "computed":{

                    showBdt(){
                        // return this.
                    }

                }
            });

        </script>

    @stop
