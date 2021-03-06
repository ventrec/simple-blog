@extends('layouts.layout')

@section('content')
<div id="content">
    <h1 class="blog-post-title">Create new post</h1>
    {{ Form::open([
        'route'     => ['home.update', $blogpost->year, $blogpost->month, $blogpost->day, $blogpost->slug],
        'class'     => 'form-horizontal',
        'role'      =>  'form',
        'method'    => 'patch'
        ]) }}
    @if(Session::has('messages'))
        @foreach(Session::get('messages') as $message)
            <p class="text-danger">{{ $message }}</p>
        @endforeach
    @endif
    <div class="form-group">
        <label for="InputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            {{ Form::text('title', $blogpost->title, array('class' => 'form-control', 'id' => 'InputTitle', 'placeholder' => 'Enter title')) }}
        </div>
    </div>
    <div class="form-group">
        <label for="InputText" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">
            {{ Form::textarea('text', $blogpost->text, array('class' => 'form-control', 'id' => 'InputText', 'placeholder' => 'Body')) }}
            <span class="help-block">Remember to use HTML-tags while writing the body. Paragraph-tags (&#60;p&#62;paragraph&#60;/p&#62;) are required.</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop