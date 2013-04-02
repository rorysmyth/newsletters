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


    public function action_new()
    {
        $sites = Site::lists('title', 'id');
        return View::make('site.templates.new')
            ->with('sites', $sites);
    }


	public function action_index()
    {

        Asset::container('footer')->add('custom', 'js/templateList.js');

        $per_page    = 20;
        $templates = DB::table('templates')->paginate($per_page, array('id', 'title', 'created_at') );
        
        return View::make('site.templates.index')
            ->with('templates', $templates);
    }

    public function action_edit($id)
    {
    	$template = Template::find($id);
        Asset::container('footer')->add('custom', 'js/templateEdit.js');
    	return View::make('site.templates.edit')->with('template', $template);
    }
	
} // END public class Newsletters_Controller extends Base_Controller

