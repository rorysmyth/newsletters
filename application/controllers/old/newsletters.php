<?php

class Newsletters_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$newsletters = DB::table('newsletters')->order_by('updated_at', 'desc')->get();
		return View::make('newsletters.index')
				->with('newsletters', $newsletters);
	}

	public function get_new()
	{
		$sites = Site::lists('title','id');
		
		$message = Session::get('message');

		return View::make('newsletters.new')
			->with('sites', $sites)
			->with('message', $message);
	}

	public function post_new()
	{
		$data = Input::all();
		$newsletter = new Newsletter;
		$newsletter->fill($data);
		$newsletter->save();

		return Redirect::to('/newsletters')
			->with('message', 'Newsletter added!');
	}

	public function get_edit($id)
	{
		$newsletter = Newsletter::find($id);
		$blocks = Block::where('newsletter_id', '=' ,$id)->get();

		$final_view = "";
		foreach ($blocks as $block) {

			/* elements */
			$data = array(
				'title' => $block->brick->s_1_title,
				'url'   => $block->brick->s_1_url,
				'img'   => $block->brick->s_1_img
			);

			$tmp_view =  View::make('templates.' . $block->template, $data);
			$final_view .= $tmp_view;
		}
		return $final_view;
	}

}