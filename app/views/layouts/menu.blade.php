<li <? echo (
Route::getCurrentRoute()->getName() == '' 
OR Route::getCurrentRoute()->getName() == 'home.show'
OR Route::getCurrentRoute()->getName() == 'home.edit'
OR Route::getCurrentRoute()->getName() == 'home.new'
) ? 'class="active"' : ''  ?>><a href="{{ action('HomeController@index') }}">Home</a></li>
@if(!Auth::check())
    <li <? echo (Route::getCurrentRoute()->getName() == 'admin.login') ? 'class="active"' : '' ?>><a href="{{ action('AdminController@login') }}">Log in</a></li>
@else
    <li><a href="{{ action('AdminController@logout') }}">Log out</a></li>
@endif