@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Attributes</div>

                    <div class="panel-body">
                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table-striped" style="width:100%">
                                <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Relation</th>
                                </thead>
                                @foreach($attributes as $attribute)

                                    <tr>
                                        <td><a href="{{ url("/attributes/".$attribute->id."/edit") }}">{{ $attribute->id }}</a></td>
                                        <td>{{ $attribute->title }}</td>
                                        @foreach($relations as $relation)
                                            @if($relation->id == $attribute->relation)
                                                <td>{{ $relation->title }}</td>
                                            @endif
                                        @endforeach
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
