@extends('layouts.layout')

@section('content')
    <div class="blog-post">
        <h1 class="blog-post-title">{{{ $blogpost->title }}}</h1>
        @if(!Auth::check())
            <p class="blog-post-meta">{{ $blogpost->date }} by {{ BlogPost::find($blogpost->id)->user->username }}</p>
        @else
            <p class="blog-post-meta">
                {{ $blogpost->date }} by {{ BlogPost::find($blogpost->id)->user->username }} //
                <a href="{{ action('HomeController@destroy', $blogpost->id) }}">Delete</a> - <a href="{{ action('HomeController@edit', $blogpost->id) }}">Edit</a>
            </p>
        @endif
        {{$blogpost->text}}

        @foreach($comments as $comment)
            <div class="blog-comment">
                <h5>Date: {{ $comment->created_at }} - By: {{ $comment->user->username }}</h5>
                <p>{{ $comment->text }}</p>
            </div>
        @endforeach
    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop