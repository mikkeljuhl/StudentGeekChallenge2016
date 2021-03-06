@extends('layouts.app')
<?php use App\Http\Controllers\OrderController; ?>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Order placed the {{ $date }}</div>

                    <div class="panel-body">

                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                        <div class="table-responsive">

                            <table class="table-striped" style="width:100%;">
                                <thead>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>VAT</th>
                                </thead>

                            @foreach($invoice_lines as $line)
                                <tr>
                                    <td>{{ $line->product_sku }}</td>
                                    <td>{{ $line->qty }}</td>
                                    <td>{{ $line->price }}</td>
                                    <td>{{ $line->price * $line->qty }}</td>
                                    <td>{{ OrderController::getVAT($line->price * $line->qty) }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td>{{ $order->shipping_method_title }}</td>
                                    <td>1</td>
                                    <td>{{ $order->shipping_method_price }}</td>
                                    <td>{{ $order->shipping_method_price }}</td>
                                    <td>0</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total: </strong></td>
                                    <td>{{ $order->subtotal + $order->tax + $order->shipping_method_price}}</td>
                                </tr>

                            </table>


                        </div>
                            <a href="{{ url("/orders/overview") }}" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
