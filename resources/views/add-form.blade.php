@extends('basic')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3"></div>

            <div class="col-6">
                <br>
                <div class="text-center"><h3>ADD BINAR FORM</h3></div>
                <br>
                <form action="{{ route('save') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label>Parent Node</label>sudo
                            <select id="parent" name="parent_id" class="form-control">
                                @foreach( $parents as $item)
                                    <option value="{{ $item->id }}">{{ $item->id }}</option>
                                @endforeach
                            </select>
                        </div>

                    <a role="button" id="choose" class="btn btn-outline-secondary" onclick="parent()">Choos Binar</a>

                    <div id="position" class="form-group">
                            <label>Position</label>
                            <select id="select_position" name="position" class="form-control">
                            </select>
                    </div>

                    <button id="button" type="submit" class="btn btn-primary">Add node</button>
                </form>
            </div>

            <div class="col-3"></div>
        </div>
        <div class="text-center"><a href="{{ route('main') }}" class="btn btn-secondary">to Main Page</a></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script>

        var host = window.location.hostname;

            $('#position').hide();
            $('#button').hide();

            function parent(){
                let id = $('#parent').val();
                $('#choose').hide();

                $.ajax({
                    type: "GET",
                    url: 'http://' + host + '/positions/'+ id,
                    success: function (data) {
                        let position = JSON.parse(data);
                        if(position){
                            $('#position').show();
                            position.forEach(function(el) {
                                $("#select_position").append( '<option value="' + el.value + '">' + el.label + '</option>');
                            });
                            $('#button').show();
                        }
                    },
                    error: function (data) {
                        console.log('Errror');
                    }
                });
            }

    </script>

@endsection
