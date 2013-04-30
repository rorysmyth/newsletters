<?php

class Api_Sites_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        
    }

    public function delete_index($id)
    {    
        $site = Site::find($id);
        $site->delete();
        $data = array(
            'status'       => true,
            'redirect_url' => URL::to_route('sites_all')
        );
        return Response::json($data);
    }

    public function post_index()
    {
        $rules = array(
            'title' => 'required|unique:sites,title',
            'label' => 'required|size:7|unique:sites,label'
        );

        $site = new Site();

        $new = array(
            'title'   => Input::get('title'),
            'label'   => Input::get('label')
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('site_new')
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $site->title = Input::get('title');
            $site->label = Input::get('label');
            $site->save();
            return Redirect::to_route('sites_all');
        }


    }

    public function put_index($id)
    {
        $site = Site::find($id);

        $data = array(
            'title' => Input::get('title'),
            'label' => Input::get('label')
        );

        $rules = array();

        if(($data['title'] != $site->title)){
            $rules['title'] = 'required|unique:sites';
        };

        if(($data['label'] != $site->label)){
            $rules['label'] = 'required|size:7|unique:sites,label';
        };

        $validation = Validator::make($data, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('sites', $id)
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $site->title = $data['title'];
            $site->label = $data['label'];
            $site->save();
            return Redirect::to_route('sites_all')
                ->with('alert', $site->title . ' updated!');
        }
        
    }

}