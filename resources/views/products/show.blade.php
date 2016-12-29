@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>

                    @if(session()->get('message'))
                    <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                    @endif

                    <div class="panel-body">
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->price }}</td>

                        <div class="form-group" style="margin-top:20px;">
                            <div class="col-md-12 col-md-offset-4">
                                <a href="{{ url('/basket/add/'.$product->id) }}" class="btn btn-primary" role="button">Add to basket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
