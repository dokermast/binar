@extends('basic')

@section('content')

    <div class="text-center">
        <h3>Main PAGE</h3>
        <br>
        <a href="{{ route('add') }}" class="btn btn-primary">Add Binar</a>
        <br>
        <br>
        <br>
    </div>

    <div class="text-center container" id="binars">

        @if ($binars)
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>parent_id</th>
                        <th>position</th>
                        <th>path</th>
                        <th>level</th>
                        <th>Show Relatives</th>
                    </tr>
                </thead>
                @foreach ($binars as $item)
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->parent_id}}</td>
                        <td>{{ $item->position}}</td>
                        <td>{{ $item->path}}</td>
                        <td>{{ $item->level}}</td>
                        <td><a class="btn btn-outline-secondary" href="{{ route('relatives', $item->id) }}">Show</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="text-center"><h4>NO Binars List</h4></div>
        @endif

    </div>

@endsection
