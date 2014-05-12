<?php

class Blogpost extends Eloquent {

    // Table name defined here as it's not in plural form
    //protected $table = 'blogpost';

    // Rules for validating a post
    public static $rules = array(
        'title' => 'required|min:2',
        'text' => 'required'
    );

    // // AND DATE_FORMAT(created_at, \'%Y.%m.%d\') = ?
    //         $format = $year . '.' . $month . '.' . $day;
    //         $blogPost = blogpost::where('slug', '=', $slug)->findOrFail();
    //         // $blogPost = Blogpost::whereRaw('slug = ?', array($slug))->findOrFail();

    protected $appends = array('link', 'year', 'month', 'day');

    /**
     * Retrieves the user object associated with the post
     *
     * @return mixed
     */
    public function user() 
    {
        return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function getLinkAttribute() 
    {
        return date('Y/m/d', strtotime($this->created_at)) .'/'. $this->slug;
    }

    public function getYearAttribute()
    {
        return date('Y', strtotime($this->created_at));
    }

    public function getMonthAttribute()
    {
        return date('m', strtotime($this->created_at));
    }

    public function getDayAttribute()
    {
        return date('d', strtotime($this->created_at));
    }

    /**
     * Retrieves a post if the date and slug matches a post in the database
     * 
     * @param  [type] $query [description]
     * @param  [int] $year  [description]
     * @param  [int] $month [description]
     * @param  [int] $day   [description]
     * @param  [string] $slug  [description]
     * @return [type]        [description]
     */
    public function scopePostBySlugAndDate($query, $year, $month, $day, $slug)
    {
        $format = $year .'.'. $month .'.'. $day;

        return $query->whereRaw('slug = ? AND DATE_FORMAT(created_at, \'%Y.%m.%d\') = ?', array($slug, $format));
    }

    /**
     * Retrieves the 10 latest blog posts order by date descending 
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeLatestPosts($query)
    {
        return $query->orderBy('id', 'desc')->limit(10);
    }
}