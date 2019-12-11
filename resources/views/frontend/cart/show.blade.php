    @extends('frontend.layouts.master')

    @section('content')
        <div class="container">
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
                                <td><a target="_blank" href="">{{ $items['title'] }}</a> </td>
                                <td>{{ number_format($items['unit_price'],2) }}</td>
                                <td><input type="number" value="{{ $items['quantity'] }}"></td>
                                <td>{{ number_format($items['total_price'],2) }}</td>
                                <td>
                                    <form action="{{ route('cart.delete',$key) }}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button title="Remove Product" class="btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach

                    <tr>
                            <td></td>
                            <td> </td>
                            <td></td>
                            <td>Total:</td>
                            <td>{{ $total }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

    @stop
