@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>

                                </thead>
                                @foreach($categories as $category)
                                    <tr>
                                        <td><a href="{{ url("/categories/".$category->id."/edit")  }}">{{ $category->id }}</a></td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->slug }}</td>
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
