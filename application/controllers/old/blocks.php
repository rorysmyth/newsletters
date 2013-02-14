<?php

class Blocks_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$blocks = Block::order_by('title')->get();
		return View::make('blocks.index')
			->with('blocks', $blocks);
	}

	public function get_new()
	{
		// get list of all bricks
		$bricks = Brick::lists('title','id');

		// get list of all newsletters
		$newsletters = Newsletter::lists('title','id');

		return View::make('blocks.new')
			->with('bricks', $bricks)
			->with('newsletters', $newsletters)
			->with('templates', Helpers::getTemplates() );
	}

	public function post_new()
	{
		$data = Input::all();
		$block = new Block;
		$block->fill($data);
		$block->save();

		return Redirect::to('/blocks')
			->with('message', 'Block added!');
	}

}