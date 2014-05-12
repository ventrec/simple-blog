@extends('layouts.layout')

@section('content')
    @foreach($blogposts as $post)
        <div class="blog-post">
            <h1 class="blog-post-title"><a href="{{ action('HomeController@show', array($post->year, $post->month, $post->day, $post->slug)) }}">{{{ $post->title }}}</a></h1>
            @if(Auth::check() AND Auth::user()->isAdmin())
                {{ Form::open(array('method' => 'delete', 'role' => 'form', 'class' => 'form-inline blog-post-meta', 'route' => array('home.destroy', $post->link))) }}
                    {{ $post->created_at->diffForHumans() }} By {{ $post->user->username }} // 
                    {{ Form::submit('Delete', array('class' => 'btn btn-primary btn-post')) }}
                    - <a href="{{ action('home.edit', array($post->year, $post->month, $post->day, $post->slug)) }}" class="btn btn-primary btn-post" role="button">Edit</a>
                {{ Form::close() }}
            @else
                <p class="blog-post-meta">{{ $post->created_at->diffForHumans() }} by {{ BlogPost::find($post->id)->user->username }}</p>
            @endif
            {{ $post->text }}
        </div>
    @endforeach

    {{ $blogposts->links() }}
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop