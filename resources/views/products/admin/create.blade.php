@extends('layouts.app')

@section("header")



@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create product</div>
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


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/products/store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

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
                                    <input id="sku" type="text" class="form-control" name="sku" value="{{ old('sku') }}" required>

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
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>

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
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @foreach($attribute_relations as $attribute_relation)
                                <div class="form-group{{ $errors->has("att_r_".$attribute_relation->id) ? ' has-error' : '' }}">
                                    <label for="att_r_{{$attribute_relation->id}}" class="col-md-4 control-label"> {{ $attribute_relation->title }}</label>
                                    <div class="col-sm-6">
                                        <select name="att_r_{{$attribute_relation->id}}" id="att_r_{{$attribute_relation->id}}" class="form-control">
                                            <option value=""></option>
                                            @foreach($attributes as $attribute)
                                                @if($attribute->relation == $attribute_relation->id)
                                                    <option value="{{ $attribute->id }}" {{ (old("att_r_".$attribute_relation->id) == $attribute->id ? "selected":"") }}>{{ $attribute->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                                <label for="categories" class="col-md-4 control-label">Categories</label>
                                <div class="col-md-6">
                                    @foreach($categories as $category)
                                    <input type="checkbox" name="categories[]" id="{{$category->id}}" value="{{ $category->id }}" > {{ $category->title }}<br/>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
                                <label for="short_description" class="col-md-4 control-label">Short description</label>

                                <div class="col-md-6">
                                    <input id="short_description" type="text" class="form-control" name="short_description" value="{{ old('short_description') }}" required>

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
                                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image_url') ? ' has-error' : '' }}">
                                <label for="image_url" class="col-md-4 control-label">Image URL (jpg only)</label>

                                <div class="col-md-6">
                                    <input id="image_url" accept="image/jpeg,image/png" type="file" class="form-control" name="image_url"/>

                                    @if ($errors->has('image_url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image_url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save and Publish
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
