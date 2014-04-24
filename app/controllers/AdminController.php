<?php

class AdminController extends BaseController {

    /**
     * Sends the user to the login screen if the user isn't already logged in. Redirected to homepage if already logged in.
     *
     * @return mixed
     */
    public function getIndex() {
        if(!Auth::check())
            return Redirect::to('admin/login');
        else
            return Redirect::to('/');
    }

    /**
     * Displays the login page
     *
     * @return mixed
     */
    public function getLogin() {
        if(!Auth::check()) {
            $blogPosts = Blogpost::orderBy('id', 'desc')->limit(10)->get();
            return View::make('admin.login')->with('blogposts', $blogPosts);
        } else {
            return Redirect::to('/');
        }

    }

    /**
     * Logges out the user and redirects to the frontpage
     *
     * @return mixed
     */
    public function getLogout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return Redirect::to('/');
    }

    /**
     * Verifies user information and logs in user if verification is successful
     *
     * @return mixed
     */
    public function postVerify() {
        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            return Redirect::to('/');
        } else {
            return Redirect::to('admin/login')
                ->with('err_msg', 'Your username/password combinations was incorrect.')
                ->withInput();
        }
    }
}