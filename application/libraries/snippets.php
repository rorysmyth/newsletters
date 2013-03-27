<?php

class Snippets {

	public static function related($id)
	{
		// get the snippet
		$snippet = Snippet::find($id);

		// get the newsletter
		$newsletter = Newsletter::find($snippet->newsletter_id);

		// get all snippets with the same title
		$related = $newsletter->snippet()->where('title', '=', $snippet->title)->get();

		return $related;

	}

}