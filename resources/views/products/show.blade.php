@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $product->title }}</div>

                    <div class="panel-body">

                    @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                            <div class="row">
                                <div class="col-sm-5">
                                    @if($product->image_url)
                                        <img src="{{ url($product->image_url) }}" alt="{{$product->title}}" style="width:100%;"/>
                                    @endif
                                    <legend style="margin-top:20px;margin-bottom:5px;">Attributes</legend>
                                    <table class="table-striped" style="width:75%;">

                                    @foreach($product_attribute_relations as $relation)
                                        @foreach($product_attributes as $product_attribute)
                                            @foreach($attributes as $attribute)
                                                @if($product_attribute->attribute_id == $attribute->id && $relation->id == $attribute->relation)
                                                <tr>
                                                    <td><strong>{{ $relation->title }}:</strong></td>
                                                    <td>{{ $attribute->title }}</td>
                                                </tr>
                                                @endif
                                        @endforeach
                                    @endforeach
                                        @endforeach
                                    </table>
<legend style="margin-top:20px;margin-bottom:5px;">Categories</legend>
                                    <table class="table-striped" style="width:75%">

                                        @foreach($categories as $category)
                                            <tr><td>{{ $category->title }}</td></tr>
                                        @endforeach

                                    </table>

                                </div>


                                <div class="col-sm-7">
                                <h1>{{ $product->title }}</h1>
                                    <h3>
                                        {{ $product->short_description }}
                                    </h3>

                                    <p>
                                        {{ $product->description }}
                                    </p>

                                    <span style="font-size:20px;" class="price">
                                        {{ $product->price * 1.25 }},- </span>incl. VAT

                                    <p><small style="font-size:8px;">SKU: {{$product->sku}}</small></p>


                                    <div class="form-group" style="margin-top:20px;">

                                            <a href="{{ url('/basket/add/'.$product->id) }}" class="btn btn-success" role="button">Add to basket</a>

                                    </div>

                                </div>



                            </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
