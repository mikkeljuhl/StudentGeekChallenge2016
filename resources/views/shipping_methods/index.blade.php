@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>

                    <div class="panel-body">

                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif


                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Minimum order price</th>

                                </thead>
                                @foreach($methods as $method)
                                    <tr>
                                        <td><a href="{{ url("/shipping/methods/".$method->id."/edit")  }}">{{ $method->id }}</a></td>
                                        <td>{{ $method->title }}</td>
                                        <td>{{ $method->price }}</td>
                                        <td>{{ $method->min_order_price }}</td>
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
