@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-dark mb-2 mt-2">Back</a>
    <div class="card card-body bg-white text-center">
        {!! Form::open(['action' => ['PostsController@update' , $post->id],'method' => 'POST','enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$post->title,['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$post->body,[ 'class' => 'form-control','placeholder' => 'Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('submit',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
