<?php

class Api_Newsletters_Controller extends Base_Controller {

    public $restful = true;

    public function get_index($id)
    {
        $newsletter = Newsletter::get_single_newsletter($id);
        return Response::eloquent($newsletter);
    }

    public function put_index($id)
    {
        $newsletter = Newsletter::find($id);
        Newsletter::update_newsletter($newsletter->id);
        return true;
    }

    public function delete_index($id)
    {
        return false; //tmp
        Newsletter::delete_newsletter($id);
        Newsletters::deleteDir($id);
        return true;
    }
    
    public function post_index()
    {

        $rules = array(
            'title'    => 'required',
            'template' => 'required',
            'site_id'  => 'required'
        );

        $data = array(
            'title'    => Input::get('title'),
            'template' => Input::get('template'),
            'site_id'  => Input::get('site_id')
        );

        $validation = Validator::make($data, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('newsletters_new');

        } else {
            $new_newsletter = Newsletter::add_newsletter($data);
            return Redirect::to_route('newsletters', $new_newsletter->id);
        }
    }

    public function post_duplicate($id)
    {
        $original = Newsletter::find($id);
        $blueprint = array(
            'title'    => Input::get('title'),
            'template' => $original->template,
            'site_id'  => $original->site_id
        );
        $clone = Newsletter::add_newsletter($blueprint);
        $snippets = $original->snippet()->get(array('title', 'value', 'variation'));
        $clone->snippet()->save($snippets);
        return Redirect::to_route('newsletters', $clone->id);
    }

    public function get_snippets($id, $variation = 'default')
    {
        $newsletter = Newsletter::find($id);
        $snippets = $newsletter->Snippet()
            ->where('variation', '=', $variation)
            ->get(array(
                'id',
                'title',
                'value',
                'variation',
            ));
        return Response::eloquent($snippets);
    }

}