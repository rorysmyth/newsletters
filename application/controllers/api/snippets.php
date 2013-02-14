<?php

class Api_Snippets_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        $result = Snippet::find($id);
        $snippet = array(
            'id' => $id = $result->id,
            'title' => $result->title,
            'value' => $result->value
        );    
        return Response::json($snippet);
    }

    public function post_index()
    {
        $snippet = new Snippet();
        $snippet->title = Input::get('title');
        $snippet->value = Input::get('value');
        $snippet->newsletter_id = Input::get('newsletter_id');
        $snippet->save();
    }

    public function put_index($id)
    {
        $snippet = Snippet::find($id);
        $snippet->value = Input::get('value');
        $snippet->save();
    }

    public function delete_index($id)
    {
        $snippet = Snippet::find($id);
        $snippet->delete();
    }

}