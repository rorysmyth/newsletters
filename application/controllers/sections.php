<?php

/**
 * Newsletters Controller
 *
 * @package default
 * @author 
 *
 **/
class Sections_Controller extends Base_Controller
{

		/**
		 * Create restful controller
		 *
		 * @var restful
		 **/
		public $restful = true;


		/**
		 * View all newsletters
		 *
		 * @return string
		 **/
		public function get_index()
		{
        	return View::make('newsletters.index');
		}

		/**
		 * HANDLER: Adding new newsletters
		 *
		 * @return string
		 **/
		public function post_index()
		{
			$data = array(
				'title' => Input::get('title'),
				'value' => Input::get('value')
			);
			
			$section = new Snippet;
			$section->fill($data);
			$section->save();

			return "added";
		}

		/**
		 * HANDLER: Updating Newsletter Record
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function put_index($id)
		{
			return "putting" . Input::get('id');
		}

		/**
		 * HANDLER: Delete newsletter record
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function delete_index($id)
		{
			return "deleteing newsletter with id of " . $id;
		}

		/**
		 * Adding a new newsletter
		 *
		 * @return string
		 **/
		public function get_new()
		{
			return "adding new newsletter";
		}

		/**
		 * Editing Newsletter
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function get_edit($id)
		{
			return View::make('newsletters.index');
            $var = new Data;
		}

		/**
		 * Render email output
		 *
		 * @return string
		 * @author Rory Smyth
		 **/
		public function get_render($id)
		{
			return "rendering newsletter with id of " . $id;
		}
	
} // END public class Newsletters_Controller extends Base_Controller

