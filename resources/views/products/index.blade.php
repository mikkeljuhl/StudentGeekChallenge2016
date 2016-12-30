@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>



                    <div class="panel-body">
                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif


                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                    <th>Title</th>
                                    <th>Price</th>


                                </thead>
                                @foreach($products as $product)
                                    <tr>
                                        <td><a href="{{ url("/products/".$product->slug) }}">{{ $product->title }}</a></td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if(Auth::check() && Auth::user()->role == "a")
                                                <a href="{{ url("/products/".$product->id."/edit")  }}">Edit</a>
                                            @endif
                                        </td>
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
