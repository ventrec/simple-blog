<?php

class Blogpost extends Eloquent {

    // Table name defined here as it's not in plural form
    protected $table = 'blogpost';

    // Rules for validating a post
    public static $rules = array(
        'title' => 'required|min:2',
        'body' => 'required'
    );

    /**
     * Retrieves the user object associated with the post
     *
     * @return mixed
     */
    public function user() {
        return $this->belongsTo('User', 'author', 'id');
    }
}