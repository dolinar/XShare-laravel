@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/uploads/create" class="btn btn-primary">Upload new image</a>
                    <h3>Your Gallery</h3>
                    @if(count($uploads) > 0)
                    <table class="table table-striped">
                        <tr>
                        <td>Title</td>
                        <td></td>
                        <td></td>
                        </tr>
                        @foreach ($uploads as $upload)
                            <tr>
                                <td>{{$upload->title}}</td>
                                <td><a href="/uploads/{{$upload->id_upload}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>{!!Form::open(['action' => ['UploadsController@destroy', $upload->id_upload], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no posts!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
