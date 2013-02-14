<?php

class Api_Newsletters_Controller extends Base_Controller {

    public $restful = true;

    public function get_index($id)
    {
        $newsletter = Newsletter::find($id);
        $out = array(
            'title' => $newsletter->title,
            'template' => $newsletter->template
        );
        return Response::json($out);
    }

    public function put_index($id)
    {
        $newsletter = Newsletter::find($id);
            $newsletter->template = Input::get('template');
            $newsletter->title = Input::get('title');
        $newsletter->save();
    }

    public function delete_index($id){
        $newsletter = Newsletter::find($id);
        $newsletter->delete();
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
            return Redirect::to_route('newsletters', $newsletter->id);
        }
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
                'title' => $snippet->title,
                'value' => $snippet->value
            );
            array_push($cloned_snippets, $clone_snippet_data);
        }

        $clone->snippet()->save($cloned_snippets);

        // go the new cloned newsletter
        return Redirect::to_route('newsletters', $clone->id);
    }

    public function get_snippets($id)
    {
        $newsletter = Newsletter::find($id);
        $snippets = $newsletter->Snippet()->get(array('id', 'title'));
        return Response::json($snippets);
    }

    public function get_html($id)
    {
        return(htmlentities(Helpers::renderTemplate($id)));
    }

    public function get_code($id)
    {
        return Helpers::renderTemplate($id);
    }

    public function get_template($id)
    {
        return Response::json(Newsletter::find($id));

    }

}