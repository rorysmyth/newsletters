<?php

class Snippets_Controller extends Site_Base_Controller
{

	public $restful = true;

	public function get_index($id = null)
	{
	    return Response::json(Snippet::find($id));
	}

	public function post_index()
	{
		$snippet = new Snippet();
			$snippet->title = Input::get('title');
			$snippet->value = Input::get('value');
			$snippet->newsletter_id = Input::get('newsletter_id');
			$snippet->save();
		return "success";
	}

	public function put_index($id)
	{
		$snippet = Snippet::find($id);
		$snippet->value = Input::get('value');
		$snippet->save();
		return "success";
	}

	public function delete_index($id)
	{
		$snippet = Snippet::find($id);
		$snippet->delete();
		return "success";
	}

}