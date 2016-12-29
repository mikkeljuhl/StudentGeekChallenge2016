@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Subtotal</th>
                                </thead>
                                @foreach($orders as $order)

                                    <tr>
                                        <td><a href="{{ url("/orders/".$order->id."") }}">{{ $order->id }}</a></td>
                                        <td>{{ $order->subtotal }}</td>
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
