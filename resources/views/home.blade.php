@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     <a href="posts/create" class="btn btn-outline-dark float-right">Create Post</a>
                            <h3>Your Blog Posts</h3>
                        <hr>
                    @if(count($posts) > 0)
                            @foreach($posts as $post)
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="card-title text-primary">No. {{ $loop->iteration }}</h3>
                                    <h4 class="card-title">Title:  {{ $post->title }}</h4>

                                    <h5 class="card-subtitle mb-2">
                                        Post:  <span>{{$post->body}}</span>
                                    </h5>
                                    <h6 class="card-title">Writting On:  {{ $post->created_at }}</h6>
                                    <div class="d-inline-flex">
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-success ml-1">Edit</a>
                                        {!! Form::open(['action' => ['PostsController@destroy'
                                                     , $post->id ],'method' => 'POST' ]) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        <button type="submit" class=" btn btn-danger btn-xs ml-1">Delete</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <p class="text-center">You Have No Posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


