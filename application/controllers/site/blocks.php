<?php

class Site_Blocks_Controller extends Site_Controller {    

	public function action_index()
    {

    }    

	public function action_new()
    {
    	if(!Auth::can('create_blocks'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create blocks");
        }
        $sites = Site::lists('title', 'id');
        return View::make('site.blocks.new')
            ->with('sites', $sites);
    }    

	public function action_edit()
    {

    }

}