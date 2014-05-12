<?php

class CommentController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 * POST /comment
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Comment::$rules);

		if($validator->passes())
		{
			$comment = new Comment;
			$comment->text = Input::get('text');
			$comment->blogpost_id = Input::get('blogpost_id');
			$comment->user_id = Auth::user()->id;
			$comment->save();

			$blogpost = Blogpost::find(Input::get('blogpost_id'));

			return Redirect::action('HomeController@show', array($blogpost->year, $blogpost->month, $blogpost->day, $blogpost->slug));
		}
		else
		{
			return Redirect::back()
			->with('messages', $validator->messages()->all())
			->withInput();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /comment/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$comment = Comment::find($id);
		$comment->delete();

		return Redirect::back();
	}

}