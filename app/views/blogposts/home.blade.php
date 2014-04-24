@extends('layouts.layout')

@section('content')
    @foreach($blogposts as $post)
        <div class="blog-post">
            <h1 class="blog-post-title"><a href="{{ action('HomeController@getPost', $post->id) }}">{{{ $post->title }}}</a></h1>
            @if(!Auth::check())
                <p class="blog-post-meta">{{ $post->date }} by {{ BlogPost::find($post->id)->user->username }}</p>
            @else
                <p class="blog-post-meta">
                    {{ $post->date }} by {{ BlogPost::find($post->id)->user->username }} //
                    <a href="{{ action('HomeController@getDelete', $post->id) }}">Delete</a> - <a href="{{ action('HomeController@getEdit', $post->id) }}">Edit</a>
                </p>
            @endif
            {{ $post->text }}
        </div>
    @endforeach

    {{ $blogposts->links() }}
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop