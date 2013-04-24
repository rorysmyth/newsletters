<?php

class Api_Snippets_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id)
    {
        $snippet = Snippet::find($id);
        return Response::eloquent($snippet);
    }

    public function post_index()
    {
        
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

             // insert the snippet to default variation
            $snippet = Snippet::add_new_snippet($new);

            // get all variations
            $newsletter = Newsletter::get_single_newsletter($new['newsletter_id']);
            $snippets   = $newsletter->snippet()->get('variation');

            // if there are variations
            $all_variations = Helpers::otherVariations($new['newsletter_id']);

            if($all_variations != false)
            {
                foreach ($all_variations as $variation) {
                    $new['variation'] = $variation;
                    Snippet::add_new_snippet($new);
            }

        }
        
        $data = array(
            'status'  => true
        );
        return Response::json($data);

        }

    }

    public function put_index($id)
    {
        // $snippet = Snippet::find($id);
        
        $new = array(
            'value' => Input::get('value')
        );
        $rules = array(
            'value'         => 'required'
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            $data = array(
                'status' => false,
                'message' => $validation->errors->all()
            );
            return Response::json($data);
        } else {
            $snippet = Snippet::update_snippet($id, $new);
            $data = array(
                'status'  => true
            );
            return Response::json($data);
        }

    }

    public function delete_index($id)
    {
        $related = Snippet::snippet_siblings($id);
        foreach ($related as $snippet) {
            Snippet::delete_snippet($snippet->id);
        }
    }

    public function delete_variation($newsletter_id, $variation_name)
    {
        // get the newsletter id
        $newsletter = Newsletter::find($newsletter_id);

        // find all snippets with the variation name
        $variation = Snippet::where('variation', '=', $variation_name )->get('id');

        // delete them all
        foreach ($variation as $snippet) {
            Snippet::delete_snippet($snippet->id);
        }

        // redirect back to the page
        // return Redirect::to_route('newsletters', $newsletter_id);
        return true;
    }

}