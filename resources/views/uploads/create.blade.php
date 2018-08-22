@extends('layouts.app')

@section('content')
    <h1>Add new image</h1>
    {!! Form::open(['action' => 'UploadsController@store', 'method' => 'POST', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('titleLabel', 'Title:')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('descriptionLabel', 'Description:')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Small description of your upload'])}}
        </div>

        <div class="form-group">
            {{Form::file('image')}}
        </div>

        <div class="form-group">
            {{Form::label('isPublicLabel', 'Make image public?')}}
            {{Form::checkbox('public', '1', true, ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection