<?php

class Api_Sites_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        
    }

    public function post_index()
    {
        $rules = array(
            'title' => 'required|unique:sites,title'
        );

        $site = new Site();

        $new = array(
            'title'   => Input::get('title')
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('site_new')
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $site->title = Input::get('title');
            $site->save();
            return Redirect::to_route('sites_all');
        }


    }

    public function put_index($id)
    {
        $title       = Input::get('title');
        $site        = Site::find($id);
        $site->title = $title;
        $site->save();
        return Redirect::to_route('sites_all');
    }

}