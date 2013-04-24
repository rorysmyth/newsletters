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


    public function action_edit($id, $variation = 'default')
    {
        if(URI::segment(3) == "" ){
            return Redirect::to_route('newsletters', array($id, 'default'));
        }
        $variation_list = Helpers::allVariations($id);
        $templates = Template::lists('title', 'id');

        $newsletter = Newsletter::find($id);
        Asset::container('footer')->add('custom', 'js/newsletterEdit.js');
        return View::make('site.newsletters.edit')->with('newsletter', $newsletter)
            ->with('variation', $variation)
            ->with('variation_list', $variation_list)
            ->with('templates', $templates);
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

        $per_page    = 20;
        $newsletters = DB::table('newsletters')->paginate($per_page, array('id', 'title', 'created_at') );
        
        return View::make('site.newsletters.index')
            ->with('newsletters', $newsletters);
    }

    public function action_new()
    {
        $sites     = Site::lists('title', 'id');
        $templates = array( '' => 'Choose Template') + Template::lists('title', 'id');
        return View::make('site.newsletters.new')
            ->with('templates', $templates)
            ->with('sites', $sites);
    }
	
} // END public class Newsletters_Controller extends Base_Controller

