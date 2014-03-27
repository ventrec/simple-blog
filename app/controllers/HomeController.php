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
    public function getIndex() {
        $blogPosts = Blogpost::orderBy('id', 'desc')->paginate(10);
        return View::make('home')->with('blogposts', $blogPosts);
    }

    /**
     * Displays a single blog post
     *
     * @param $id Id of the blog post
     * @return mixed
     */
    public function getPost($id) {
        $blogPost = Blogpost::find($id);
        $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
        return View::make('blogpost')->with(array('blogpost' => $blogPost, 'blogposts' => $blogPosts));
    }

    /**
     * Displays the page for creating a new blog post
     *
     * @return mixed
     */
    public function getNew() {
        if(Auth::check()) {
            $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
            return View::make('new')->with('blogposts', $blogPosts);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Verifies data and saves it to database if data passes validation
     *
     * @return mixed
     */
    public function postVerify() {
        $validator = Validator::make(Input::all(), Blogpost::$rules);

        if($validator->passes()) {
            $blogpost = new Blogpost;
            $blogpost->title = Input::get('title');
            $blogpost->body = Input::get('body');
            $blogpost->author = Auth::user()->id;
            $blogpost->save();

            return Redirect::to('/');
        } else {
            return Redirect::to('new')
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
    public function getDelete($id) {
        if(Auth::check()) {
            Blogpost::destroy($id);
        }

        return Redirect::to('/');
    }

    /**
     * Displays the page for editing a blog post
     *
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function getEdit($id) {
        if(Auth::check()) {
            $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
            $blogPost = Blogpost::find($id);
            return View::make('edit')->with(array('blogposts' => $blogPosts, 'blogpost' => $blogPost));
        } else {
            Return Redirect::to('/');
        }
    }

    /**
     * Verifies data and updates the blog post if validation is successful
     *
     * @param $id Id related to the blog post
     * @return mixed
     */
    public function postEdit($id) {
        $validator = Validator::make(Input::all(), Blogpost::$rules);

        if($validator->passes()) {
            $blogpost = Blogpost::find($id);
            $blogpost->title = Input::get('title');
            $blogpost->body = Input::get('body');
            $blogpost->save();

            Return Redirect::to('/');
        } else {
            return Redirect::to('edit')
                ->with('messages', $validator->messages()->all())
                ->withInput();
        }
    }

}