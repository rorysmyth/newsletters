<?php
class Snippet extends Eloquent
{

	public function newsletter()
	{
		return $this->belongs_to('Newsletter');
	}

	public function variation()
	{
		return $this->belongs_to('Variation');
	}

	public static function snippet_by_section($newsletter_id, $section_title, $variation)
	{
		$title = "section_". $section_title . "_";

		$snippets = DB::table('snippets')
			->where('newsletter_id', '=', $newsletter_id)
			->where('variation', 'like', $variation)
			->where( 'title', DB::raw('rlike') , $title )
			->get(array('id','title', 'value'));

		return $snippets;
	}

	public static function add_new_snippet($data)
	{
		$snippet = new Snippet($data);
        $snippet->save();
        return $snippet;
	}

	public static function update_snippet($id, $data)
	{
		$snippet = Snippet::find($id);
		$snippet->fill($data);
		$snippet->save();
		return $snippet;
	}

	public static function delete_snippet($id)
	{
		$snippet = Snippet::find($id);
		$snippet->delete();
	}

	public static function snippet_siblings($id)
	{
		$snippet = Snippet::find($id);
		$newsletter = Newsletter::find($snippet->newsletter_id);
		$related = $newsletter->snippet()->where('title', '=', $snippet->title)->get();
		return $related;
	}

}