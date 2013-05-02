<?php

class Api_Bugs_Controller extends Base_Controller {

	public $restful = true;

	public function get_index($id)
	{
		return "getting bug";
	}

	public function post_index()
	{
		$data = array(
			'title'       => Input::get('title'),
			'priority'    => Input::get('priority'),
			'description' => Input::get('description')
		);

		$rules = array(
			'title'       => 'required',
			'priority'    => 'required|numeric',
			'description' => 'required'
		);

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::to_route('bug_new')
				->with_input()
                ->with_errors($validation->errors);
		} else {
			$bug = Bug::add_new_bug($data);
            return Redirect::to_route('bugs')
            	->with('alert', $bug->title . ' was added successfully');
		}

	}

}