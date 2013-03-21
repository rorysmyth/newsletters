<?php

class Api_Templates_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        
    }

    public function post_index()
    {
        $rules = array(
            'title' => 'required',
            'code'  => 'required'
        );

        $template = new Template();

        $new = array(
            'title'   => Input::get('title'),
            'code'    => Input::get('code'),
            'site_id' => Input::get('site_id')
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('templates_new')
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $template->title = Input::get('title');
            $template->code = Input::get('code');
            $template->site_id = Input::get('site_id');
            $template->save();
            return Redirect::to_route('newsletters_all');
        }


    }

}