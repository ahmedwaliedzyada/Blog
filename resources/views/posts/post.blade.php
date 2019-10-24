@extends('layouts.app')
@section('content')
    @include('flash::message')
<div class="mt-3 d-flex">
    <h1>Posts</h1>
    <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item">
        <a href="posts/create" class="btn btn-outline-dark float-right">Create Post</a>
        </li>
        @endauth
    </ul>
</div>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            @guest
            <div class="card card-body bg-white text-center">
                <h3>
                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                </h3>
                <small class="mb-2">Written on {{$post->created_at}} </small>
                <small>Written By : {{$post->user->name}} </small>
            </div>
                @else
                <div class="card card-body bg-white">
                    <div class="row">
                        <div class="col-md-4 col-sm-3">
                            <img src="{{$post->profileImage()}}" style="width: 100%" alt="">
                        </div>
                    </div>
                    <h3 class="mt-2">
                        <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                    </h3>
                    <small class="mb-2">Written on {{$post->created_at}} </small>
                    <small>Written By : {{$post->user->name}} </small>

                    <div class="d-flex ml-auto">
                        @if(auth()->user()->id == $post->user_id)
                        {!! Form::open(['action' => ['PostsController@destroy'
                         , $post->id ],'method' => 'POST']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <button type="submit" class="delete_post btn btn-danger btn-xs ">Delete</button>
                        {!! Form::close() !!}
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-success ml-2 delete_post ">Edit</a>
                        @endif
                    </div>

                </div>
            @endguest
        @endforeach
        {{$posts->links()}}
        @else
            <p>No Posts Found</p>
    @endif
@endsection


