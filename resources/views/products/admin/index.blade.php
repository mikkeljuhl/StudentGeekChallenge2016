@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                </thead>
                                @foreach($products as $product)

                                        <tr>
                                            <td><a href="{{ url("/products/".$product->id."/edit") }}">{{ $product->id }}</a></td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->price }}</td>
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
