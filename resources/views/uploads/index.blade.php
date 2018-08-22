@extends('layouts.app')

@section('content')
    <h1>Uploads</h1>
    @if (count($uploads) > 0)
        @foreach ($uploads as $upload)
            <div class="card" style="padding:3px">
                <img src="/storage/images/{{$upload->image}}">
                <h3><a href="/uploads/{{$upload->id_upload}}">{{$upload->title}}</a></h3>
                <small>Uploaded on: {{$upload->created_at}} by {{$upload->user->name}}</small>
            </div>
            <br>
        @endforeach
    @else
        <p>No uploaded images!</p>
    @endif 
@endsection