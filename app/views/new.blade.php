@extends('layout')

@section('content')
<div id="content">
    <h1 class="blog-post-title">Create new post</h1>
    {{ Form::open(array('url' => 'verify', 'class' => 'form-horizontal', 'role' => 'form')) }}
    @if(Session::has('messages'))
        @foreach(Session::get('messages') as $message)
            {{ $message }}
        @endforeach
    @endif
    <div class="form-group">
        <label for="InputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'InputTitle', 'placeholder' => 'Enter title')) }}
        </div>
    </div>
    <div class="form-group">
        <label for="InputBody" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">
            {{ Form::textarea('body', null, array('class' => 'form-control', 'id' => 'InputBody', 'placeholder' => 'Body')) }}
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
    @include('sidebar')
@stop