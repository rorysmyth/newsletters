<?php

class Api_Search_Controller extends Base_Controller {

    public function action_newsletter()
    {
    	$query = Input::get('query');

   //      $search_results = Newsletter::with('site')
			// ->where('title', 'LIKE', '%'.$query.'%')
			// ->get(array('title', 'id', 'site_id', $sites->title));

		 $search_results =  DB::table('sites')
	        ->join('newsletters', function($join){
	            $join->on('newsletters.site_id', '=', 'sites.id');
	        })
	        ->where('newsletters.title', 'LIKE', '%'.$query.'%')
	        ->order_by('newsletters.created_at', 'desc')
	        ->get(array(
	            'newsletters.id',
	            'newsletters.created_at',
	            'newsletters.title',
	            'sites.label',
	            'sites.title as site_title'
	        ));
	        return Response::json($search_results);
    }

}