@extends('basic')

@section('content')

    <div class="text-center">
        <h3>Binar Relatives ID: {{ $id }}</h3>
        <br>
        <a href="{{ route('main') }}" class="btn btn-secondary">to Main Page</a>
        <br>
        <br>
        <br>
    </div>

    <div class="text-center container" id="relatives">

        @if ($relatives)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>parent_id</th>
                    <th>position</th>
                    <th>path</th>
                    <th>level</th>
                </tr>
                </thead>
                @foreach ($relatives as $item)

                    @if($item->id == $id)
                        @php $bgrd = 'background: lightgrey'; @endphp
                    @else
                        @php $bgrd = ''; @endphp
                    @endif

                    <tr style="{{ $bgrd }}">
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->parent_id}}</td>
                        <td>{{ $item->position}}</td>
                        <td>{{ $item->path}}</td>
                        <td>{{ $item->level}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="text-center"><h4>NO Relatives List</h4></div>
        @endif

    </div>

@endsection
