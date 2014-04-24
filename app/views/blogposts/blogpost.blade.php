@extends('layouts.layout')

@section('content')
    <div class="blog-post">
        <h1 class="blog-post-title">{{{ $blogpost->title }}}</h1>
        @if(!Auth::check())
            <p class="blog-post-meta">{{ $blogpost->date }} by {{ BlogPost::find($blogpost->id)->user->username }}</p>
        @else
            <p class="blog-post-meta">
                {{ $blogpost->date }} by {{ BlogPost::find($blogpost->id)->user->username }} //
                <a href="{{ action('HomeController@getDelete', $blogpost->id) }}">Delete</a> - <a href="{{ action('HomeController@getEdit', $blogpost->id) }}">Edit</a>
            </p>
        @endif
        {{$blogpost->body}}
    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop