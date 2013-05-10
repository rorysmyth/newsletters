<?php

class Site_Templates_Controller extends Site_Controller
{

    public function action_new()
    {
        if(!Auth::can('create_templates'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create templates");
        }
        $sites = Site::lists('title', 'id');
        return View::make('site.templates.new')
            ->with('sites', $sites);
    }

	public function action_index()
    {
        if(!Auth::can('view_templates'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view templates");
        }

        Asset::container('footer')->add('custom', 'js/templateList.js');

        $per_page    = 20;
        $templates = DB::table('templates')->paginate($per_page, array('id', 'title', 'created_at') );
        
        return View::make('site.templates.index')
            ->with('templates', $templates);
    }

    public function action_edit($id)
    {
        if(!Auth::can('edit_templates'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view templates");
        }
    	$template = Template::find($id);
        Asset::container('footer')->add('custom', 'js/templateEdit.js');
    	return View::make('site.templates.edit')->with('template', $template);
    }

    public function action_make()
    {
        if(!Auth::can('create_templates'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create templates");
        }
        Asset::container('footer')->add('jqueryui','js/jqueryui/jqueryui.js');
        $blocks = Block::all();
        return View::make('site.templates.make')
            ->with('blocks', $blocks);
    }
	
}

