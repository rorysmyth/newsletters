<?php

/**
 * Newsletters Controller
 *
 * @package default
 * @author 
 *
 **/
class Site_Newsletters_Controller extends Site_Controller
{


    public function action_edit($id)
    {
        $newsletter = Newsletter::find($id);
        Asset::container('footer')->add('custom', 'js/newsletterEdit.js');
        return View::make('site.newsletters.edit')->with('newsletter', $newsletter);
    }

    public function action_duplicate($id)
    {
        $newsletter = Newsletter::find($id);
        return View::make('site.newsletters.duplicate')
            ->with('clone', $newsletter);
    }

    public function action_index()
    {
        Asset::container('footer')->add('custom', 'js/newsletterList.js');
        $newsletters = DB::table('newsletters')->order_by('created_at', 'desc')->get();
        return View::make('site.newsletters.index')
            ->with('newsletters', $newsletters);
    }

    public function action_new()
    {
        $sites = Site::lists('title', 'id');
        return View::make('site.newsletters.new')
            ->with('sites', $sites);
    }
	
} // END public class Newsletters_Controller extends Base_Controller

