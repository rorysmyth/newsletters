<?php


class Site_Sites_Controller extends Site_Controller
{


    public function action_new()
    {
        if(!Auth::can('create_sites'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create sites");
        }
        return View::make('site.sites.new');
    }


	public function action_index()
    {
        if(!Auth::can('view_sites'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view sites");
        }
        $per_page    = 20;
        $sites = DB::table('sites')->paginate($per_page, array('id', 'title', 'created_at') );
        
        return View::make('site.sites.index')
            ->with('sites', $sites);
    }

    public function action_edit($id)
    {
        if(!Auth::can('edit_sites'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to edit sites");
        }
        $site = Site::find($id);
        $newsletters = Site::related_newsletters($id);
        Asset::container('footer')->add('custom', 'js/sitesList.js');
        return View::make('site.sites.edit')
            ->with('site', $site)
            ->with('newsletters', $newsletters);
    }

}

