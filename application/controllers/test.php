<?php

class Test_Controller extends Base_Controller
{

	public $restful = true;

	public function get_index()
	{




$html = <<<EOD

<h1>{{title}}</h1>
<p>{{copy|textarea}}</p>
<a href="{{cta_link}}">{{cta_text}}</a>
 
EOD;
		return View::make('test')
			->with('html', $html);


	}

	public function post_index()
	{
		$processed = Input::get('html');

		$scan = preg_match_all('/\{\{(.+?)\}\}/', $processed, $matches);
		$matched_items = $matches[1];
		$unique_matches = array_unique($matched_items);

		$matches_with_values = array();
		foreach ($unique_matches as $match) {
			$values = explode('|', $match);
			array_push($matches_with_values, $values);
		}

		return View::make('test')
			->with('html', $processed)
			->with('fields', $matches_with_values);
	}

	public function get_data()
	{
		return Redirect::to('/test');
	}

	public function post_data()
	{
		$data = Input::all();
		$newsletter_id = Input::get('newsletter_id');

		foreach ($data as $key => $value) {
			if($key != "newsletter_id")
			{
				$entry['title'] = $key;
				$entry['value'] = $value;
				$entry['newsletter_id'] = $newsletter_id;
				$data_entry = new Data($entry);
				$data_entry->save();
			}
		}
		
	}

}