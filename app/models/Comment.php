<?php

class Comment extends \Eloquent {

	// Rules for validating a post
    public static $rules = array(
        'text' => 'required|min:5'
    );

	protected $fillable = array('text');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function blogpost()
	{
		return $this->belongsTo('Blogpost');
	}
}