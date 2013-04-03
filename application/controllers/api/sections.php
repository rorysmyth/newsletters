<?php

class Api_Sections_Controller extends Base_Controller
{
	public function action_group($newsletter_id, $section_title)
	{
		$title = 'section_' . $section_title . '_';
		$snippets = Snippet::snippet_by_section($newsletter_id, $title);
		return Response::eloquent($snippets);
	}

}