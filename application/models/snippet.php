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

	public static function snippet_by_section($newsletter_id, $section_title)
	{
		$snippets =  Newsletter::find($newsletter_id)
			->snippet()
			->where('title', 'like', '%'.$section_title.'%')
			->get(array('id','title', 'value'));
		return $snippets;
	}

}