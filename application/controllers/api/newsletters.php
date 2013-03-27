<?php

class Api_Newsletters_Controller extends Base_Controller {

    public $restful = true;

    // api/newsletters/1
    public function get_index($id)
    {
        $newsletter = Newsletter::where('id', '=', $id)->get(array('title', 'template'));
        return Response::eloquent($newsletter);
    }

    public function put_index($id)
    {
        $newsletter = Newsletter::find($id);

            if(Input::has('template')):
                $newsletter->template = Input::get('template');
            endif;

            if(Input::has('title')):
                $newsletter->title = Input::get('title');
            endif;

            if(Input::has('template_override')):
                $newsletter->template_override = Input::get('template_override');
            endif;

            if(Input::has('template_id')):
                $newsletter->template_id = Input::get('template_id');
            endif;

        $newsletter->save();
    }

    public function delete_index($id){
        $newsletter = Newsletter::find($id);
        $newsletter->delete();
        Newsletters::deleteDir($newsletter->id);
        return "deleted!";
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
            $newsletter = new Newsletter($data);
            $newsletter->save();
            $snippets = Helpers::templateSnippets($data['template']);
            $newsletter->snippet()->save($snippets);
            Newsletters::makeDir($newsletter->id);
            return Redirect::to_route('newsletters', $newsletter->id);
        }
    }

    public function get_search()
    {
        $query = Input::get('query');

        $matches = DB::table('newsletters')
            ->where('title', 'LIKE', '%'.$query.'%')
            ->get(array('title', 'id'));

        return Response::json($matches);
    }

    public function post_duplicate($id)
    {
        // get all values from current template
        $newsletter = Newsletter::find($id);

        // create new template with exactl same values
        $clone_data = array(
            'title' => Input::get('title'),
            'template' => $newsletter->template,
            'site_id' => $newsletter->site_id
        );
        $clone = new Newsletter($clone_data);
        $clone->save();

        // get all snippets
        $snippets = $newsletter->snippet()->get();
        
        // add all new snippets and assign them to the clone
        $cloned_snippets = array();
        foreach($snippets as $snippet)
        {
            $clone_snippet_data = array(
                'title'     => $snippet->title,
                'value'     => $snippet->value,
                'variation' => $snippet->variation
            );
            array_push($cloned_snippets, $clone_snippet_data);
        }

        $clone->snippet()->save($cloned_snippets);

        // go the new cloned newsletter
        return Redirect::to_route('newsletters', $clone->id);
    }

    public function post_variation($id)
    {
        // get the newsletter
        $newsletter = Newsletter::find($id);
        // get the fields the newsletter uses
        $snippets = $newsletter->snippet()->where('variation', '=', 'default')->get();
        // get the variation name
        
        $data = array(
            'variation' => Input::get('variation')
        );

        $rules = array(
            'variation' => 'required|unique:snippets,variation'
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
                $new_snippet->variation = Str::slug(Input::get('variation'));
                $new_snippet->save();
            }
            return Redirect::to_route('newsletters', $id)
                ->with('alert', 'Added ' . $data['variation'] . "!" );
        }

    }

    public function get_snippets($id, $variation = 'default')
    {
        $newsletter = Newsletter::find($id);
        $snippets = $newsletter->Snippet()->where('variation', '=', $variation)->get(array('id', 'title'));
        
        $output = array();
        foreach ($snippets as $snippet) {
            $single_snippet = array(
                "id" => $snippet->id,
                "title" => $snippet->title,
                "value" => $snippet->value,
                "variation" => $snippet->variation,
            );
            array_push($output, $single_snippet);
        }

        return Response::json($output);
    }

    // handles the preview tab
    public function get_html($id, $variation)
    {
        return(htmlentities(Helpers::renderTemplate($id, $variation)));
    }

    // handles the code tab
    public function get_code($id, $variation = 'default')
    {
        return Helpers::renderTemplate($id, $variation);
    }

    public function get_template($id)
    {
        return Response::json(Newsletter::find($id));
    }

}