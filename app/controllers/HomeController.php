<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    /**
     * Displays the homepage with 10 posts
     *
     * @return mixed
     */
    public function index() 
    {
        $blogPosts = Blogpost::orderBy('id', 'desc')->paginate(10);

        return View::make('blogposts.home')->with('blogposts', $blogPosts);
    }

    public function show($year, $month, $day, $slug) 
    {     
        try 
        {
            // $blogPost = Blogpost::retrievePost($year, $month, $day, $slug);
            $blogPost = Blogpost::PostBySlugAndDate($year, $month, $day, $slug)->firstOrFail();
        }
        catch(Exception $e)
        {
            return Redirect::to('/');
        }

        return View::make('blogposts.blogpost')->with(
        array(
            'blogpost' => $blogPost, 
            'blogposts' => Blogpost::LatestPosts()->get(), 
            'comments' => $blogPost->comments()->get()
        ));
    }

    /**
     * Displays the page for creating a new blog post
     *
     * @return mixed
     */
    public function create() 
    {
        return View::make('blogposts.new')->with('blogposts', Blogpost::LatestPosts()->get());
    }

    /**
     * Verifies data and saves it to database if data passes validation
     *
     * @return mixed
     */
    public function store() 
    {
        $validator = Validator::make(Input::all(), Blogpost::$rules);

        if($validator->passes()) 
        {
            $blogpost = new Blogpost;
            $blogpost->title = Input::get('title');
            $blogpost->slug = Str::slug(Input::get('title'), '_');
            $blogpost->text = Input::get('text');
            $blogpost->user_id = Auth::user()->id;
            $blogpost->save();

            return Redirect::to('/');
        } 
        else 
        {
            return Redirect::to('/post/new')
                ->with('messages', $validator->messages()->all())
                ->withInput();
        }
    }

    public function destroy($year, $month, $day, $slug) 
    {
        if(Auth::check())
        {
            try 
            {
                $blogPost = Blogpost::PostBySlugAndDate($year, $month, $day, $slug)->firstOrFail();
                $blogPost->delete();
            }
            catch(Exception $e)
            {
                return Redirect::to('/');
            }
        }

        return Redirect::to('/');
    }

    /**
     * Displays the page for editing a blog post
     *
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function edit($year, $month, $day, $slug) 
    {
        if(Auth::check()) 
        {
            try 
            {
                $blogPost = Blogpost::PostBySlugAndDate($year, $month, $day, $slug)->firstOrFail();
            }
            catch(Exception $e)
            {
                return Redirect::to('/');
            }

            return View::make('blogposts.edit')->with(array('blogposts' => Blogpost::LatestPosts()->get(), 'blogpost' => $blogPost));
        } 
        else 
        {
            return Redirect::to('/');
        }
    }

    /**
     * Verifies data and updates the blog post if validation is successful
     * 
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function update($year, $month, $day, $slug) 
    {
        $validator = Validator::make(Input::all(), Blogpost::$rules);

        if($validator->passes()) 
        {
            try 
            {
                $blogpost = Blogpost::PostBySlugAndDate($year, $month, $day, $slug)->firstOrFail();
            }
            catch(Exception $e)
            {
                return Redirect::to('/');
            }
            $blogpost->title = Input::get('title');
            $blogpost->slug = Str::slug(Input::get('title'), '_');
            $blogpost->text = Input::get('text');
            $blogpost->save();

            return Redirect::to('/');
        } 
        else 
        {
            return Redirect::route('home.edit', array($year, $month, $day, $slug))
                ->with('messages', $validator->messages()->all())
                ->withInput();
        }
    }
}