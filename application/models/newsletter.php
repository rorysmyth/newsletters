<?php

class Newsletter extends Eloquent
{

	public function site()
	{
		return $this->belongs_to('Site');
	}

	public function snippet()
	{
		return $this->has_many('Snippet');
	}

	public static function get_single_newsletter($id)
	{
		$newsletter = Newsletter::find($id);
		return $newsletter;
	}

	public static function update_newsletter($id)
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
            else:
                $newsletter->template_override = 0;
            endif;

            if(Input::has('template_id')):
                $newsletter->template_id = Input::get('template_id');
            endif;

        $newsletter->save();
	}

	public static function delete_newsletter($id)
	{
		$newsletter = Newsletter::find($id);
		$newsletter->delete();
	}

	public static function add_newsletter($data)
	{
		$newsletter = new Newsletter($data);
        $newsletter->save();

        // if template is sent with add
        // parse and add the snippets from the template
        if(Input::has('template')):
	        $snippets = Helpers::templateSnippets($data['template']);
	        $newsletter->snippet()->save($snippets);
        endif;

        // make unique image directory
        Newsletters::makeDir($newsletter->id);

        return $newsletter;
	}

	public static function search_newsletters($query)
	{
		$search_results = Newsletter::where('title', 'LIKE', '%'.$query.'%')->get(array('title', 'id'));
		return $search_results;
	}

	public static function duplidate_newsletter($original_id, $new_data)
	{

	}

}