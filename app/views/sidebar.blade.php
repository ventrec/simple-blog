<div class="sidebar-module">
    <h4>Latest blog items</h4>
    <ul>
        @if(count($blogposts) > 0)
        @foreach($blogposts as $post)
        <li><a href="{{ action('HomeController@getPost', $post->id) }}">{{ $post->title }}</a></li>
        @endforeach
        @else
        <li>No blog items yet.</li>
        @endif
    </ul>
</div>
@if(Auth::check())
    <div class="sidebar-module">
        <h4>Logged in</h4>
        <ul>
            <li>Username: {{ Auth::user()->username }}.</li>
            <li>Posts: {{ Auth::user()->retrievePostCount() }}.</li>
            <li><a href="{{ action('HomeController@getNew') }}">Add new post</a></li>
        </ul>
    </div>
@endif