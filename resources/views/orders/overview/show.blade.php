@extends('layouts.app')

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
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Subtotal</th>
                                </thead>
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                    </tr>
                            </table>

                            <table class="table-striped" style="width:50%;float:right;margin-top:20px;">
                                <thead>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                </thead>

                            @foreach($invoice_lines as $line)
                                <tr>
                                    <td>{{$line->product_sku}}</td>
                                    <td>{{$line->qty}}</td>
                                    <td>{{$line->price}}</td>
                                    <td>{{$line->price * $line->qty}}</td>
                                </tr>
                            @endforeach
                            </table>


                        </div>
                            <a href="{{ url("/orders/overview") }}" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
