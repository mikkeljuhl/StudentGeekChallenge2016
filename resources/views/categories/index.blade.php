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

                                <th>Title</th>


                                </thead>
                                @foreach($categories as $category)
                                    <tr>
                                        <td><a href="{{ url("/categories/".$category->slug)  }}">{{ $category->title }}</a></td>
                                        <td>
                                            @if(Auth::check() && Auth::user()->role == "a")
                                                <a href="{{ url("/categories/".$category->id."/edit")  }}">Edit</a>
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
