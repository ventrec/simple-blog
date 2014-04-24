<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Blog</title>

    <!-- Bootstrap core css -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <!-- Custom css -->
    {{ HTML::style('css/style.css') }}
</head>
<body>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ action('HomeController@getIndex') }}">Home</a></li>
            @if(!Auth::check())
                <li><a href="{{ action('AdminController@getLogin') }}">Log in</a></li>
            @else
                <li><a href="{{ action('AdminController@getLogout') }}">Log out</a></li>
            @endif
        </ul>
    </div>
</nav>

<div class="jumbotron">
    <div class="container">
        <h1>Simple blog</h1>
        <p>A simple blog made by Runar Jørgensen.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            @yield('content')
        </div>
        <div class="col-md-4">
            @yield('sidebar')
        </div>
    </div>
</div>

</body>
</html>