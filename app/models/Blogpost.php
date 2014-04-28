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

    protected $appends = array('link');

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
        return date('Y/m/d', strtotime($this->attributes['created_at'])) .'/'. $this->attributes['slug'];
    }

    public function verifyLink($year, $month, $day, $slug)
    {
        try {
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
    }
}