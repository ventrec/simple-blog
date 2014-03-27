@extends('layout')

@section('content')
<div id="content">
    <h1 class="blog-post-title">Log in</h1>
    {{ Form::open(array('url' => 'admin/verify', 'class' => 'form-horizontal', 'role' => 'form')) }}
    @if(Session::has('err_msg'))
        <p class="alert-danger">{{ Session::get('err_msg') }}</p>
    @endif
        <div class="form-group">
            <label for="InputUsername" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                {{ Form::text('username', null, array('class' => 'form-control', 'id' => 'InputUsername', 'placeholder' => 'Enter username')) }}
            </div>
        </div>
        <div class="form-group">
            <label for="InputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                {{ Form::password('password', array('class' => 'form-control', 'id' => 'InputPassword', 'placeholder' => 'Password')) }}
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