<?php

/**
 * Newsletters Controller
 *
 * @package default
 * @author 
 *
 **/
class Site_Sites_Controller extends Site_Controller
{


    public function action_new()
    {
        echo phpinfo();
        return View::make('site.sites.new');
    }


	public function action_index()
    {
        $per_page    = 20;
        $sites = DB::table('sites')->paginate($per_page, array('id', 'title', 'created_at') );
        
        return View::make('site.sites.index')
            ->with('sites', $sites);
    }

    public function action_edit($id)
    {
        $site = Site::find($id);
        $newsletters = Site::related_newsletters($id);
        Asset::container('footer')->add('custom', 'js/sitesList.js');
        return View::make('site.sites.edit')
            ->with('site', $site)
            ->with('newsletters', $newsletters);
    }

}

