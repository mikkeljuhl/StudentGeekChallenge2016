@extends('layouts.app')

@section("header")



@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit product</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/products/'.$product->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="title" class="form-control" name="title" @if(old('title'))
                                    value="{{old('title')}}" @else value="{{$product->title}}" @endif  required
                                           autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
                                <label for="sku" class="col-md-4 control-label">SKU</label>

                                <div class="col-md-6">
                                    <input id="sku" type="text" class="form-control" name="sku" @if(old('sku'))
                                    value="{{old('sku')}}" @else value="{{$product->sku}}" @endif  required>

                                    @if ($errors->has('sku'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sku') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-4 control-label">Slug</label>

                                <div class="col-md-6">
                                    <input id="slug" type="text" class="form-control" name="slug" @if(old('slug'))
                                    value="{{old('slug')}}" @else value="{{$product->slug}}" @endif required>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" @if(old('price'))
                                    value="{{old('price')}}" @else value="{{$product->price}}" @endif required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @foreach($attribute_relations as $attribute_relation)
                                <div class="form-group{{ $errors->has($attribute_relation->id) ? ' has-error' : '' }}">
                                    <label for="att_r_{{$attribute_relation->id}}"
                                           class="col-md-4 control-label"> {{ $attribute_relation->title }}</label>
                                    <div class="col-sm-6">
                                        <select name="att_r_{{$attribute_relation->id}}"
                                                id="att_r_{{$attribute_relation->id}}" class="form-control">
                                            <option value=""></option>

                                            @foreach($attributes as $attribute)
                                                @if($attribute->relation == $attribute_relation->id)
                                                    @foreach($product_attributes as $product_attribute)
                                                        @if($product_attribute->attribute_id == $attribute->id)
                                                            <option value="{{ $attribute->id }}"
                                                                    {{ ($product_attribute->attribute_id == $attribute->id ? "selected":"") }}>
                                                                {{ $attribute->title }}
                                                            </option>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    <option value="{{ $attribute->id }}"
                                                            {{ ($product_attribute->attribute_id == $attribute->id ? "selected":"") }}>
                                                        {{ $attribute->title }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach


                            <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
                                <label for="short_description" class="col-md-4 control-label">Short description</label>

                                <div class="col-md-6">
                                    <input id="short_description" type="text" class="form-control"
                                           name="short_description" @if(old('short_description'))
                                           value="{{old('short_description')}}"
                                           @else value="{{$product->short_description}}" @endif required>

                                    @if ($errors->has('short_description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('short_description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    @if(old('description'))
                                        <textarea id="description" class="form-control"
                                                  name="description">{{old('sku')}}</textarea>
                                    @else
                                        <textarea id="description" class="form-control"
                                                  name="description">{{$product->description}}</textarea>
                                    @endif

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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
