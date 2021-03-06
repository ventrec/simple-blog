<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * Returns the amount of posts created by the user
     *
     * @return int
     */
    public function retrievePostCount() {
        // return DB::table('blogposts')->where('user_id', $this->id)->count();
        return $this->hasMany('Blogpost');
    }

    /**
     * Verification rules used with the log in
     *
     * @var array
     */
    public static $rules = array(
        'username' => 'required|alpha|min:2',
        'password' => 'required'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function isAdmin()
    {
        if($this->access_level >= 10) return true;

        return false;
    }
}