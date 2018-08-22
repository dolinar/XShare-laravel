@extends('layouts.app')

@section('content')
    <h1>Edit image info</h1>
    {!! Form::open(['action' => ['UploadsController@update', $upload->id_upload], 'method' => 'POST', 'class' => 'form']) !!}
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            {{Form::label('titleLabel', 'Title:')}}
            {{Form::text('title', $upload->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('descriptionLabel', 'Description:')}}
            {{Form::textarea('description', $upload->description, ['class' => 'form-control', 'placeholder' => 'Small description of your upload'])}}
        </div>

        <div class="form-group">
            {{Form::label('isPublicLabel', 'Make image public?')}}
            {{Form::checkbox('public', '1', $upload->public, ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection