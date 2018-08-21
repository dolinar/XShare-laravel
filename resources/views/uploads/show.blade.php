@extends('layouts.app')

@section('content')
    <h1>{{$upload->title}}</h1>
    <div class="card" style="padding:3px">
        <h3>{{$upload->description}}</h3>
        <small>Uploaded on: {{$upload->created_at}}</small>
    </div>
@endsection