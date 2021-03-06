@extends('layouts.app')

@section('content')
    <h1>{{$upload->title}}</h1>
    <div class="card" style="padding:3px">
        <img src="/storage/images/{{$upload->image}}">
        <br>
        <h3>{{$upload->description}}</h3>
        <p>Uploaded on: {{$upload->created_at}} by {{$upload->user->name}}</p>
    </div>
    <hr>

    @if(!Auth::guest())
        @if(Auth::user()->id == $upload->id_user)
            <a href="/uploads/{{$upload->id_upload}}/edit" class="btn btn-default">Edit</a> 

            {!!Form::open(['action' => ['UploadsController@destroy', $upload->id_upload], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}
        @endif
    @endif
@endsection