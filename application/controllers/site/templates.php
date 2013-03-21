<?php

/**
 * Newsletters Controller
 *
 * @package default
 * @author 
 *
 **/
class Site_Templates_Controller extends Site_Controller
{


    public function action_index()
    {
        $sites = Site::lists('title', 'id');
        return View::make('site.templates.new')
            ->with('sites', $sites);
    }

	
} // END public class Newsletters_Controller extends Base_Controller

