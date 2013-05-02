<?php

class Site_Roles_Controller extends Site_Controller
{
	public function action_index()
	{
		$roles = \Verify\Models\Role::all();
		return View::make('site.roles.index')
			->with('roles', $roles);
	}

	public function action_new()
	{
		return View::make('site.roles.new');
	}
}