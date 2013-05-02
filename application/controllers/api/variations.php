<?php

class Api_Variations_Controller extends Base_Controller {


	public $restful = true;

	public function post_index($id)
    {
        // get the newsletter
        $newsletter = Newsletter::find($id);
        
        // get the fields the newsletter uses
        $snippets = $newsletter->snippet()->where('variation', '=', 'default')->get();
        
        // get the variation name
        $data = array(
            'variation' => Str::slug(Input::get('variation'))
        );

        $existing_variations = $newsletter->snippet()->get('variation');

        $unique_variations = array();
        foreach ($existing_variations as $snippet) {
            if(!in_array($snippet->variation, $unique_variations))
            {
                array_push($unique_variations, $snippet->variation);
            }
        }

        if(in_array($data['variation'], $unique_variations))
        {
            Session::flash('alert', 'Already exists');
            return Redirect::to_route('newsletters_variation', $id)
                ->with_input();
        }

        $rules = array(
            'variation' => 'required'
        );

        $validation = Validator::make($data, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('newsletters_variation', $id)
                ->with_input()
                ->with_errors($validation->errors);

        } else {
            // duplicate the fields (names and values) for the newsletter using the variation name in the variation field
            foreach ($snippets as $snippet) {
                $new_snippet = new Snippet();
                $new_snippet->title = $snippet->title;
                $new_snippet->value = $snippet->value;
                $new_snippet->newsletter_id = $snippet->newsletter_id;
                $new_snippet->variation = $data['variation'];
                $new_snippet->save();
            }
            return Redirect::to_route('newsletters', array($id, $new_snippet->variation))
                ->with('alert', 'Added ' . $data['variation'] . "!" );
        }

    }

    public function get_index($id)
    {
        $variations = Helpers::allVariations($id);
        return Response::json($variations);
    }

    public function get_generate_files($id)
    {
        
    }

}