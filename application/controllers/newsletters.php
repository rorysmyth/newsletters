<?php

/**
 * Newsletters Controller
 *
 * @package default
 * @author 
 *
 **/
class Newsletters_Controller extends Base_Controller
{

		/**
		 * Create restful controller
		 *
		 * @var restful
		 **/
		public $restful = true;


		/**
		 * View newsletter
		 *
		 * @return string
		 **/
		public function get_index($id = null)
		{
			/// page specific javascript
			Asset::container('page_scripts')
				->add('newsletter_main','js/pages/newsletter.js');

			$newsletter = Newsletter::find($id);

			$handlebar_data = array('base_url' => 'test.com');

			return View::make('newsletters.edit')
				->with('newsletter', $newsletter)
				->with('handlebar_data', $handlebar_data);
		}

		public function get_snippets($id = null)
		{
			$newsletter = Newsletter::find($id);
			$snippets = $newsletter->Snippet()->get();
			return Response::json($snippets, 200);
		}

		/**
		 * HANDLER: Adding new newsletters
		 *
		 * @return string
		 **/
		public function post_index()
		{
			
		}

		/**
		 * HANDLER: Updating Newsletter Record
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function put_index($id)
		{
			$newsletter = Newsletter::find($id);
			$newsletter->template = Input::get('template');
			$newsletter->save();
			return "success";
		}

		/**
		 * HANDLER: Delete newsletter record
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function delete_index($id)
		{

		}

		/**
		 * Adding a new newsletter
		 *
		 * @return string
		 **/
		public function get_new($id)
		{
		}

		/**
		 * Editing Newsletter
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function get_edit($id)
		{
			
		}

		/**
		 * Render email output
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function get_render($id)
		{
			return(htmlentities(Helpers::renderTemplate($id)));
		}

		public function get_preview($id)
		{
			return Helpers::renderTemplate($id);
		}

		public function get_template($id)
		{
			return Response::json(Newsletter::find($id));

		}
	
} // END public class Newsletters_Controller extends Base_Controller

