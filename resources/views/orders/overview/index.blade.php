@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Order overview</div>

                    <div class="panel-body">
                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Subtotal</th>
                                <th>Shipping</th>
                                <th>Total</th>
                                </thead>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><a href="{{ url("/orders/overview/".$order->id."") }}">{{ $order->id }}</a></td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->shipping_method_price }}</td>
                                        <td>{{ $order->subtotal * 1.25 + $order->shipping_method_price}}</td>

                                    </tr>
                                @endforeach


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
