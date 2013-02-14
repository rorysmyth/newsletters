<?php

class Blocks_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		return "view all blocks";
	}

	public function get_new()
	{
		// get list of all bricks
		$bricks = Brick::lists('title','id');

		// get list of all newsletters
		$newsletters = Newsletter::lists('title','id');

		return View::make('blocks.add')
			->with('bricks', $bricks)
			->with('newsletters', $newsletters);
	}

	public function post_new()
	{
		return "added";
	}

}