<?php

class Site_Variations_Controller extends Site_Controller
{

	public function action_index($id)
	{
		if(!Auth::can('view_variations'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view users");
        }
		if(!Auth::can('duplicate_newsletter'))
		{
			return Redirect::to_route('newsletters', $id)
				->with('alert', 'You cant perform this action');
		}
		$newsletter = Newsletter::find($id);
        return View::make('site.variations.new')
            ->with('clone', $newsletter);

	}

	public function action_delete($newsletter_id, $variation)
	{
		if(!Auth::can('delete_variations'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to delete variations");
        }
		$newsletter = Newsletter::find($newsletter_id);
        return View::make('site.variations.delete')
            ->with('newsletter', $newsletter)
            ->with('variation', $variation);
	}

}