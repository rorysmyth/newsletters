<?php

class Site_Auth_Controller extends Site_Controller
{

	public $restful = true;

	public function get_index()
	{
		return View::make('site.login.index');
	}

	public function post_index()
	{
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'url'      => Input::get('url')
		);

		if ( Auth::attempt($userdata) )
		{
		    // return Redirect::to(URL::to_route('newsletters'));
		    return Redirect::to( $userdata['url'] );
		}
		else
		{
		    return Redirect::to(URL::to_route('login'))
		        ->with('login_errors', 'username or password incorrect');
		}

	}

}