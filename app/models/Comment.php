<?php

class Comment extends \Eloquent {
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