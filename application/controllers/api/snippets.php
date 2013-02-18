<?php

class Api_Snippets_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        $result = Snippet::find($id);
        $snippet = array(
            'id'    => $id = $result->id,
            'title' => $result->title,
            'value' => $result->value
        );    
        return Response::json($snippet);
    }

    public function post_index()
    {
        $snippet                = new Snippet();
        
        $new = array(
            'title'         => Input::get('title'),
            'value'         => Input::get('value'),
            'newsletter_id' => Input::get('newsletter_id')
        );

        $rules = array(
            'title'         => 'required',
            'value'         => 'required'
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            $data = array(
                'status'  => false,
                'message' => $validation->errors->all()
            );
            return Response::json($data);
        } else {
            $snippet->title         = Input::get('title');
            $snippet->value         = Input::get('value');
            $snippet->newsletter_id = Input::get('newsletter_id');
            $snippet->save();
            $data = array(
                'status'  => true
            );
            return Response::json($data);
        }

    }

    public function put_index($id)
    {
        $snippet = Snippet::find($id);
        
        $new = array(
            'value' => Input::get('value')
        );
        $rules = array(
            'value'         => 'required'
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            $data = array('status' => false, 'message' => $validation->errors->all() );
            return Response::json($data);
        } else {
            $snippet->value = Input::get('value');
            $snippet->save();
            $data = array(
                'status'  => true
            );
            return Response::json($data);
        }

    }

    public function delete_index($id)
    {
        $snippet = Snippet::find($id);
        $snippet->delete();
    }

}