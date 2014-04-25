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

    /**
     * Displays a single blog post
     *
     * @param $id Id of the blog post
     * @return mixed
     */
    public function show($year, $month, $day, $slug) 
    {     
        try {
            //AND DATE_FORMAT(created_at, \'%Y.%m.%d\') = ?
            $format = $year . '.' . $month . '.' . $day;
            $blogPost = Blogpost::whereRaw('slug = ? AND DATE_FORMAT(created_at, \'%Y.%m.%d\') = ?', array($slug, $format))->firstOrFail();
            // $blogPost = Blogpost::where('slug', '=', $slug)->firstOrFail();

            if ( ($year !== $blogPost->created_at->format('Y')) OR ($month !== $blogPost->created_at->format('m')) OR ($day !== $blogPost->created_at->format('d')) )
            {
                return Redirect::to('/');
            }

        } catch (Exception $e) {
            return Redirect::to('/');
        }

        $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
        $comments = $blogPost->comments()->get();

        return View::make('blogposts.blogpost')->with(array('blogpost' => $blogPost, 'blogposts' => $blogPosts, 'comments' => $comments));
    }

    /**
     * Displays the page for creating a new blog post
     *
     * @return mixed
     */
    public function create() 
    {
        $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();

        return View::make('blogposts.new')->with('blogposts', $blogPosts);
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
            return Redirect::to('/new')
                ->with('messages', $validator->messages()->all())
                ->withInput();
        }
    }

    /**
     * Deletes a blog post from the database
     *
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function destroy($slug) 
    {
        if(Auth::check()) Blogpost::destroy($slug);

        return Redirect::to('/');
    }

    /**
     * Displays the page for editing a blog post
     *
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function edit($slug) 
    {
        if(Auth::check()) 
        {
            $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
            $blogPost = Blogpost::find($id);

            return View::make('blogposts.edit')->with(array('blogposts' => $blogPosts, 'blogpost' => $blogPost));
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
    public function update($id) 
    {
        $validator = Validator::make(Input::all(), Blogpost::$rules);

        if($validator->passes()) 
        {
            $blogpost = Blogpost::find($id);
            $blogpost->title = Input::get('title');
            $blogpost->slug = Str::slug(Input::get('title'), '_');
            $blogpost->text = Input::get('text');
            $blogpost->save();

            return Redirect::to('/');
        } 
        else 
        {
            return Redirect::to('blogposts.edit')
                ->with('messages', $validator->messages()->all())
                ->withInput();
        }
    }
}