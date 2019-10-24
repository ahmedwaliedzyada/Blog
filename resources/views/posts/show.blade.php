@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-dark mb-2 mt-2">Back</a>
    @if(auth()->user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-info float-right mb-2 mt-2">Edit</a>
    {!! Form::open(['action' => ['PostsController@destroy'
                 , $post->id ],'method' => 'POST' ,'class' => 'float-right mr-2']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    <button type="submit" class="delete_post btn btn-danger btn-xs mb-2 mt-2">Delete</button>
    {!! Form::close() !!}
    @endif
            <div class="card card-body bg-white text-center">
                <img class="m-auto" src="{{$post->profileImage()}}" style="width: 40%" alt="">
                <h3 class="m-2">{{$post->title}}</h3>
                <p> {{$post->body}} </p>
                <hr>
                <small>Written on {{$post->created_at}} </small>
                <small>Written By : {{$post->user->name}} </small>
            </div>
@endsection
