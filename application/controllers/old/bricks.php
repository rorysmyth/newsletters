<?php

class Bricks_Controller extends Base_Controller
{

	public $restful = true;

	public function get_index()
	{
		$bricks =  Brick::order_by('updated_at', 'desc')->get();
		return View::make('bricks.index')
			->with('bricks', $bricks);
	}

	public function get_new()
	{
		return View::make('bricks.new');	
	}

	public function post_new()
	{
		$data = Input::all();
		$brick = new Brick;
		$brick->fill($data);
		$brick->save();

		return Redirect::to('/bricks');

	}

}