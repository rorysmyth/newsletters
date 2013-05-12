<?php

class Api_Sections_Controller extends Base_Controller
{
	public function action_group($newsletter_id, $section_title, $variation)
	{
		$snippets = Snippet::snippet_by_section($newsletter_id, $section_title, $variation);
		return Response::json($snippets);
		// return Response::eloquent($snippets);
	}

}