@extends('layouts.app')

@section("header")



@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit shipping method: {{ $method->title }}</div>
                    <div class="panel-body">
                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/shipping/methods/'.$method->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">

                                    <input id="title" type="title" class="form-control" name="title" @if(old('title'))
                                    value="{{old('title')}}" @else value="{{$method->title}}" @endif required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" @if(old('price'))
                                    value="{{old('price')}}" @else value="{{$method->price}}" @endif required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('min_order_price') ? ' has-error' : '' }}">
                                <label for="min_order_price" class="col-md-4 control-label">Minimum order price</label>

                                <div class="col-md-6">
                                    <input id="min_order_price" type="text" class="form-control" name="min_order_price" @if(old('min_order_price'))
                                    value="{{old('min_order_price')}}" @else value="{{$method->min_order_price}}" @endif required>

                                    @if ($errors->has('min_order_price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('min_order_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")


@endsection
