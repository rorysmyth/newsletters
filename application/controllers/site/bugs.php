<?php

class Site_Bugs_Controller extends Site_Controller
{

	public function action_index()
	{
		$per_page    = 20;

		$bugs_p1 = Bug::where('status', '!=', 'resolved')
					->where('priority', '=', 1)
					->order_by('priority')
					->get();

		$bugs_p2 = Bug::where('status', '!=', 'resolved')
					->where('priority', '=', 2)
					->order_by('priority')
					->get();

		$bugs_p3 = Bug::where('status', '!=', 'resolved')
					->where('priority', '=', 3)
					->order_by('priority')
					->get();

		$resolved = Bug::where('status', '=', 'resolved')
					->get();

		return View::make('site.bugs.index')
			->with('bugs_p1', $bugs_p1)
			->with('bugs_p2', $bugs_p2)
			->with('bugs_p3', $bugs_p3)
			->with('resolved', $resolved);
	}

	public function action_new()
	{
		return View::make('site.bugs.new');
	}

}