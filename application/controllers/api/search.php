<?php

class Api_Search_Controller extends Base_Controller {

    public function action_newsletter()
    {
        $search_results = Newsletter::search_newsletters(Input::get('query'));
        return Response::eloquent($search_results);
    }

}