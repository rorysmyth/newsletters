<?php

class Helpers {

	public static function getTemplates()
	{
		// directory holding the blade templates
		$dir = scandir('application/views/templates');
		
		// files to exclude
		$exclude = array('.', '..');
		
		// remove the unwanted files
		$files = array_diff($dir, $exclude);

		// get values
		$values = array_values($files);

		//clean values
		$clean = str_replace('.blade.php', '', $values);

        // create new "clean" array
		$arr = array_combine($clean, $clean);

		// return
		return $arr;
	}

	public static function renderTemplate($id, $variation)
	{
			// get the newsletter id we're working with
			$newsletter = Newsletter::find($id);

			$override = $newsletter->template_override;

			// get the template
			if($override == 1){
				$static_template = Template::find($newsletter->template_id);
				$template = $static_template->code;
			} else {
				$template = $newsletter->template;
			}

			// get the related snippet fields
			$snippets = $newsletter->snippet()->where('variation','=', $variation)->get();

			// identify variables in the template
			// wil look for {{variables}}
			$scan_variables = preg_match_all('/\{\{(.+?)\}\}/', $template, $matches);

				// move the matched items into their own single array
				$single_match_array =  $matches[1];

				// no need for duplicated
				$unique_template_variables = array_unique($single_match_array);				

			// replace the variables with the snippet value field
			foreach ($snippets as $key => $snippet) {

				// check if the snippets are in the template
				if(!(in_array($snippet->title, $unique_template_variables)))
				{
					// record doesn't exist in the array
					//show error
				}

				// if the variables all exist, start replacing them
				$template = str_replace('{{'.$snippet->title.'}}', $snippet->value, $template);

			}

			return $template;
	}

	public static function allVariations($id)
	{
		$newsletter = Newsletter::find($id);
		$snippets   = $newsletter->snippet()->get('variation');

			if(!empty($snippets))
			{
				$single_snippet = array_map(function($object){
					return $object->to_array();
				}, $snippets);

				$all_variations = array();
				foreach ($single_snippet as $snippet) {
					if(!in_array($snippet['variation'], $all_variations))
					{
						array_push($all_variations, $snippet['variation']);
					}
				}

				return $all_variations;
			}
	}

	public static function otherVariations($id)
	{
		$newsletter = Newsletter::find($id);
		$snippets   = $newsletter->snippet()->get('variation');

			if(!empty($snippets))
			{
				$single_snippet = array_map(function($object){
					return $object->to_array();
				}, $snippets);

				$all_variations = array();
				foreach ($single_snippet as $snippet) {
					if(!in_array($snippet['variation'], $all_variations) && $snippet['variation'] != 'default')
					{
						array_push($all_variations, $snippet['variation']);
					}
				}

				return $all_variations;
			}
			return false;
	}

	public static function templateSnippets($template)
	{
		$scan = preg_match_all('/\{\{(.+?)\}\}/', $template, $matches);
		$matched_items = $matches[1];
		$unique_matches = array_unique($matched_items);

		$snippets = array();
		foreach ($unique_matches as $match) {
			$snippet = array('title' => $match, 'value' => $match);
			array_push($snippets, $snippet);
		}

		return $snippets;
	}

	public static function niceDate($date)
	{
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
		return $date->format('M dS') . ' at ' . $date->format('H:i');
	}
	
}