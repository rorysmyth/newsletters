<?php

class Site_Newsletters_Controller extends Site_Controller
{


    public function action_edit($id, $variation = 'default')
    {
        
        if(!Auth::can('edit_newsletters'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to edit newslettters");
        }

        if(URI::segment(3) == "" ){
            Session::reflash();
            return Redirect::to_route('newsletters', array($id, 'default'));
        }

        $variation_list = Helpers::allVariations($id);
        $templates = Template::lists('title', 'id');


        if (Config::get('cdn_discover') != false) {
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
        }

        $newsletter = Newsletter::find($id);
        Asset::container('footer')->add('custom', 'js/newsletterEdit.js');
        return View::make('site.newsletters.edit')
            ->with('newsletter', $newsletter)
            ->with('variation', $variation)
            ->with('variation_list', $variation_list)
            ->with('cdn_images', Cache::get('cdn_images'))
            ->with('templates', $templates)
            ->with('alert', 'you are an idiot');
    }

    public function action_duplicate($id)
    {
        if(!Auth::can('duplicate_newsletters'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to duplicate newslettters");
        }

        $newsletter = Newsletter::find($id);
        return View::make('site.newsletters.duplicate')
            ->with('clone', $newsletter);
    }

    public function action_index()
    {

        if(!Auth::can('view_newsletters'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view newsletters");
        }

        $months = array(
            ""   => "Select a month",
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "May",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Aug",
            "09" => "Sep",
            "10" => "Oct",
            "11" => "Nov",
            "12" => "Dec"
        );

        $years = array(
            ""     => "Select a year",
            '2012' => '2012',
            '2013' => '2013'
        );

        $sites = array( '' => 'All Sites') + Site::lists('title', 'id');

        Asset::container('footer')->add('custom', 'js/newsletterList.js');
        $per_page    = 10;

        switch (Request::method()) {
            case 'GET':
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

                break;

            case 'POST':
                
                $keywords = Input::get('keywords');
                $site     = Input::get('site');
                $month    = Input::get('month');

                Session::flash('keywords', $keywords);
                Session::flash('site', $site);
                Session::flash('month', $month);
                
                if($month != "")
                {
                    $start_date = $month - 1;
                    $end_date   = $month + 1;

                } else {

                    $start_date = '00';
                    $end_date   = '12';
                }

                $newsletters =  DB::table('sites')
                    ->join('newsletters', function($join){
                        $join->on('newsletters.site_id', '=', 'sites.id');
                    })
                    ->where('newsletters.title', 'LIKE', '%'.$keywords.'%')
                    ->where('newsletters.site_id', 'LIKE', '%'.$site.'%')
                    ->where( DB::raw('MONTH(newsletters.created_at)'), '>', $start_date )
                    ->where( DB::raw('MONTH(newsletters.created_at)'), '<', $end_date )
                    ->order_by('newsletters.created_at', 'desc')
                    ->paginate($per_page, array(
                        'newsletters.id',
                        'newsletters.created_at',
                        'newsletters.title',
                        'sites.label',
                        'sites.title as site_title'
                    ));

                break;
        }
        
        return View::make('site.newsletters.index')
            ->with('newsletters', $newsletters)
            ->with('sites', $sites)
            ->with('months', $months)
            ->with('years', $years);
    }

    public function action_new()
    {
        if(!Auth::can('create_newsletters'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create newslettter");
        }

        $sites     = Site::lists('title', 'id');
        $templates = array( '' => 'Choose Template') + Template::lists('title', 'id');
        return View::make('site.newsletters.new')
            ->with('templates', $templates)
            ->with('sites', $sites);
    }
	
}

