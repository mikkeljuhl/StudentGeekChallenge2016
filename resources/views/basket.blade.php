@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <table style="width:100%;">
                            <thead>
                                <th>Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </thead>
                        @foreach($basket_items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Subtotal:</strong></td>
                                <td>{{ $subtotal  }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Tax:</strong></td>
                                <td>{{ $tax }}</td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total:</strong></td>
                                <td>{{ $subtotal + $tax }}</td>
                            </tr>
                        </table>

                        <div class="form-group" style="margin-top:20px;">
                            <div class="col-md-12 col-md-offset-10">
                                <a href="{{ url('/orders/details') }}" class="btn btn-primary" role="button">Buy now</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
