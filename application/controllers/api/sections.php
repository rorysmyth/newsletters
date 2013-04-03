<?php

class Api_Sections_Controller extends Base_Controller
{
	public function action_group($newsletter_id, $section_title, $variation)
	{
		$title = 'section_' . $section_title . '_';
		$snippets = Snippet::snippet_by_section($newsletter_id, $title, $variation);
		return Response::eloquent($snippets);
	}

}