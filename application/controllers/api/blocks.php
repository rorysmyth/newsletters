<?php

class Api_Blocks_Controller extends Base_Controller {

	public $restful = true;    

	public function post_index()
    {
    	$rules = array(
            'title' => 'required',
            'code'  => 'required'
        );

        $block = new Block();

        $new = array(
            'title'   => Input::get('title'),
            'slug'    => Str::slug(Input::get('title')),
            'code'    => Input::get('code'),
            'site_id' => Input::get('site_id')
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('blocks_new')
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $block->title = Input::get('title');
            $block->slug = $new['slug'];
            $block->code = Input::get('code');
            $block->site_id = Input::get('site_id');
            $block->save();
            return Redirect::to_route('blocks_all');
        }
    }    

	public function put_index()
    {

    }

}