<?php

class Site_Newsletters_Controller extends Site_Controller
{


    public function action_edit($id, $variation = 'default')
    {
        if(URI::segment(3) == "" ){
            return Redirect::to_route('newsletters', array($id, 'default'));
        }

        $variation_list = Helpers::allVariations($id);
        $templates = Template::lists('title', 'id');

        if(! Cache::has('cdn_images'))
        {
            $cloudfiles = Ioc::resolve('cloudfiles');
            $cdn_images_db_115x71 = $cloudfiles->get_container("Images DataBase 115x71 - HC Main Newsletter")->list_objects();
            $cdn_images_db_140x105 = $cloudfiles->get_container("Images DataBase 140x105 - HW Main Newsletter")->list_objects();
            $cdn_images_db_70x50 = $cloudfiles->get_container("Images DataBase 70x50 - HW Main Newsletter")->list_objects();
            $all_images = array_merge($cdn_images_db_70x50, $cdn_images_db_140x105, $cdn_images_db_115x71);
            $cdn_images = htmlentities(json_encode($all_images));
            Cache::put('cdn_images', $cdn_images, 60);
        }

        $cdn_images = Cache::get('cdn_images');

        $newsletter = Newsletter::find($id);
        Asset::container('footer')->add('custom', 'js/newsletterEdit.js');
        return View::make('site.newsletters.edit')->with('newsletter', $newsletter)
            ->with('variation', $variation)
            ->with('variation_list', $variation_list)
            ->with('cdn_images', Cache::get('cdn_images'))
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
        
        $newsletters =  DB::table('sites')
                        ->join('newsletters', function($join){
                            $join->on('newsletters.site_id', '=', 'sites.id');
                        })
                        ->order_by('newsletters.created_at', 'desc')
                        ->paginate($per_page, array(
                            'newsletters.id',
                            'newsletters.created_at',
                            'newsletters.title',
                            'sites.label',
                            'sites.title as site_title'
                        ));

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

