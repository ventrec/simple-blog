@extends('layouts.layout')

@section('content')
    <div class="blog-post">
        <h1 class="blog-post-title">{{{ $blogpost->title }}}</h1>
        @if(Auth::check() AND Auth::user()->isAdmin())
            {{ Form::open(array('method' => 'delete', 'role' => 'form', 'class' => 'form-inline blog-post-meta', 'route' 
                => array('home.destroy', $blogpost->link))) }}
                {{ $blogpost->created_at->diffForHumans() }} By {{ $blogpost->user->username }} // 
                {{ Form::submit('Delete', array('class' => 'btn btn-primary btn-post')) }}
                - <a href="{{ action('HomeController@edit', array($blogpost->year, $blogpost->month, $blogpost->day, $blogpost->slug)) }}" class="btn btn-primary btn-post" role="button">Edit</a>
            {{ Form::close() }}
        @else
            <p class="blog-post-meta">{{ $blogpost->created_at->diffForHumans() }} by {{ BlogPost::find($blogpost->id)->user->username }}</p>
        @endif
        {{$blogpost->text}}

        <h2>Comments</h2>

        @foreach($comments as $comment)
            <div class="blog-comment">
                <h5>Date: {{ $comment->created_at->diffForHumans() }} - By: {{ $comment->user->username }}</h5>
                @if(Auth::check() AND Auth::user()->isAdmin())
                    {{ Form::open(array('method' => 'delete', 'role' => 'form', 'class' => 'form-inline blog-post-meta', 'route' 
                        => array('comment.destroy', $comment->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-default btn-post')) }}
                    {{ Form::close() }}
                @endif
                <p>{{ $comment->text }}</p>
            </div>
        @endforeach

        @if(Auth::check())
            <h2>Write comment</h2>
            @if(Session::has('messages'))
                @foreach(Session::get('messages') as $message)
                    <p class="text-danger">{{ $message }}</p>
                @endforeach
            @endif
            {{ Form::open(array('route' => array('comment.store'), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch')) }}
                {{ Form::hidden('blogpost_id', $blogpost->id) }}
                <div class="form-group">
                    <label for="InputComment" class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-6">
                        {{ Form::textarea('text', null, array('class' => 'form-control', 'id' => 'InputComment', 'placeholder' => 'Write your comment here.')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
                    </div>
                </div>
            {{ Form::close() }}
        @endif
    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop