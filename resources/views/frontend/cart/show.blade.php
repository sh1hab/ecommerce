@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <br>

        <p class="text-center">Cart<p>
        <hr>

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
@php dd($cart) @endphp
            <tbody>
                @php $i=1; @endphp
                @foreach ($cart as $key => $items)
                    <tr>
                            
                            <td>{{ $i++ }}</td>
                            <td><a target="_blank" href="">{{ $items['title'] }}</a> </td>
                            <td>{{ $items['unit_price'] }}</td>
                            <td><input type="number" value="{{ $items['quantity'] }}"></td>
                            <td>{{ $items['unit_price'] }}</td>
                            <td>
                                <form action>
                                    <input type="hidden" name="method" value="delete">
                                    @csrf
                                    <button class="btn-sm btn-danger">Remove<button>
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