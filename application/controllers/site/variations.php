<?php

class Site_Variations_Controller extends Site_Controller
{

	public function action_index($id)
	{
		$newsletter = Newsletter::find($id);
        return View::make('site.variations.new')
            ->with('clone', $newsletter);
	}

	public function action_delete($newsletter_id, $variation)
	{
		$newsletter = Newsletter::find($newsletter_id);
        return View::make('site.variations.delete')
            ->with('newsletter', $newsletter)
            ->with('variation', $variation);
	}

}